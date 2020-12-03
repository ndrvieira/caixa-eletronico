<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\TransactionType;
use DateTime;
use DateTimeZone;
use stdClass;

class ATM
{
    /** @var array $notas */
    private static $money_bills = [100, 50, 20];
    /** @var int $delay Tempo em milisegundos para refazer uma operação em caso de operações concorrentes */
    private static $delay = 1000;
    /** @var int $max_tries Número máximo de tentativas para refazer uma operação em caso de operações concorrentes */
    private static $max_tries = 5;
    /** @var Account $account Conta do cliente */
    private $account;
    /** @var int $value Valor do saque */
    private $value;
    /** @var TransactionType $type Tipo da transação */
    private $transaction_type;
    /** @var array $returning_bills O conjunto de notas que o caixa eletrônico deve retornar */
    private $returning_bills;

    public function __construct(Account $account, TransactionType $transaction_type, int $value)
    {
        $this->account = $account;
        $this->transaction_type = $transaction_type;
        $this->value = $value;
    }

    /**
     * Inicia uma operação na conta do usuário
     * @param int $retries
     * @return Account
     */
    public function initiateOperation(int $retries = 0)
    {
        try {
            return $this->mutateAccount();
        } catch (\Exception $e) {
            if ($e->getMessage() == 'Caixa ocupado, por favor tente mais tarde' && $retries <= self::$max_tries) {
                $retries++;
                usleep(self::$delay * 1000);
                return $this->initiateOperation($retries);
            }
            throw $e;
        }
    }

    /**
     * Realiza um saque/depósito
     * @return {
     *    returning
     * }
     */
    private function mutateAccount()
    {
        $this->verfifiesAccountBusyErrors();
        if ($this->setAccountBusy(true) === 0) {
            abort(503, 'Caixa ocupado, por favor tente mais tarde');
        }

        try {
            /** @var Account $account Recarregando informações da conta */
            $account = (new AccountService)->customFindOrFail($this->account->id);
            /** Verificando se a operação é válida */
            $this->operationIsValid();
            /** Atualizando a conta */
            $this->account = $account;
            if ($this->transaction_type->name === 'deposit') {
                $this->account->amount += $this->value;
            } else if ($this->transaction_type->name === 'withdraw') {
                $this->account->amount -= $this->value;
            } else {
                abort(400, 'Erro. Tipo de transação não encontrada.');
            }
            $this->account->save();
        } catch (\Exception $e) {
            /** Caso falhe, seta a conta para não ocupada para não travar a conta */
            $this->setAccountBusy(false);
            throw $e;
        }

        (new TransactionService)->createTransaction($this->account, $this->transaction_type, $this->value);

        $this->setAccountBusy(false);
        $return = new stdClass();
        $return->returning_bills = $this->returning_bills;
        $return->account = $this->account;
        return $return;
    }

    /**
     * Seta a conta para ocupada/desocupada, dependendo do parâmetro passado, previne requisições concorrentes
     * @param boolean $status
     * @return mixed
     */
    private function setAccountBusy(bool $status)
    {
        return Account::where('id', $this->account->id)->where('busy', !$status)->update(['busy' => $status]);
    }

    /**
     * Verifica se a operação é válida
     */
    private function operationIsValid()
    {
        if ($this->transaction_type->name === 'withdraw') {
            if ($this->account->amount < $this->value) {
                abort(400, 'Você não tem saldo suficiente para este saque');
            } else if (empty($this->calculateMoneyBills($this->value))) {
                abort(400, 'Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100');
            }
        }
    }

    /**
     * Todas as exceptions tem tratamento para destravar a conta, mas só para garantir, quando uma conta ficar ocupada por mais de 15 segundos
     * o sistema desbloqueia essa conta para evitar que ela fique presa.
     */
    private function verfifiesAccountBusyErrors()
    {
        $now = time();
        try {
            $timezone = new DateTimeZone(getenv('APP_TIMEZONE')) ?? null;
        } catch (\Exception $e) {
            abort(500, 'Timezone configurada incorretamente');
        }
        $last_update = DateTime::createFromFormat('Y-m-d H:i:s', $this->account->updated_at, $timezone)->getTimestamp();
        if ($now - $last_update > 15) {
            $this->setAccountBusy(false);
        }
    }

    /**
     * Calcula a quantidade de cada nota que o caixa deve retornar, colocando como prioridade as notas mais altas,
     * nesse ponto, o saldo já foi verificado e o cliente possui saldo suficiente
     * 
     * @param int $value
     * @return array
     */
    private function calculateMoneyBills(int $value)
    {
        $final_bills = $this->getBillSet(self::$money_bills, $value);
        $this->returning_bills = $final_bills;
        return $final_bills;
    }

    /**
     * @param array $available_bills Conjunto de notas disponíveis
     * @param int $value Valor do saque
     * @return array
     */
    private function getBillSet(array $available_bills, int $value)
    {
        $bill_set = [];
        $mutable_value = $value;
        foreach ($available_bills as $bill) {
            $number_of_bills = $this->getNumberOfBills($bill, $mutable_value);
            $bill_set[$bill] = $number_of_bills;
            $mutable_value -= $bill * $number_of_bills;
        }

        /** Se foi possivel zerar o valor com esse set, volta */
        if ($mutable_value === 0) {
            /** Se foi possivel zerar o valor com esse set, retorna esse set */
            return $bill_set;
        } else if ($mutable_value !== 0 && count($available_bills) >= 2) {
            /** Se não, mas ainda existe a possibilidade, tenta com essa nova possibilidade, q vai remover o ultimo elemento do array */
            array_shift($available_bills);
            return $this->getBillSet($available_bills, $value);
        } else {
            dd([$mutable_value, $bill, $number_of_bills, $bill * $number_of_bills]);
            return [];
        }
    }

    /**
     * Retorna a quantidade de notas que aquele valor pode retornar
     * 
     * @param int $bill Valor que deseja subtrair
     * @param int $value Valor de quem deseja subtrair
     * @param int $number Número de subtrações
     * @return int
     */
    private function getNumberOfBills(int $bill, int $value, int $number = 0)
    {
        if ($value >= $bill) {
            $value -= $bill;
            $number++;
            if ($value >= $bill) {
                return $this->getNumberOfBills($bill, $value, $number);
            }
        }
        return $number;
    }
}
