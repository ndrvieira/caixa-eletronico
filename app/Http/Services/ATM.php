<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\TransactionType;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            if ($e->getCode() === 503 && $retries <= self::$max_tries) {
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
        $this->verifiesAccountBusyErrors();
        if ($this->setAccountBusy(true) === 0) {
            throw new HttpException(503, 'Caixa ocupado, por favor tente mais tarde', null, [], 503);
            // abort(503, 'Caixa ocupado, por favor tente mais tarde');
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
                throw new HttpException(400, 'Erro. Tipo de transação não encontrada.', null, [], 400);
            }
            $this->account->save();
        } catch (\Exception $e) {
            /** Caso falhe, seta a conta para não ocupada para não travar a conta */
            $this->setAccountBusy(false);
            throw $e;
        }

        (new TransactionService)->createTransaction($this->account, $this->transaction_type, $this->value);

        $this->setAccountBusy(false);
        $return = new \stdClass();
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
                throw new HttpException(400, 'Você não tem saldo suficiente para este saque', null, [], 400);
            } else if (empty($this->calculateMoneyBills($this->value))) {
                throw new HttpException(400, 'Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100', null, [], 400);
            } else if ($this->sumCalculatedMoneyBills() !== $this->value) {
                throw new HttpException(500, 'Erro ao obter notas', null, [], 500);
            }
        }
    }

    

    /**
     * Todas as exceptions tem tratamento para destravar a conta, mas só para garantir, quando uma conta
     * ficar ocupada por mais de 15 segundos, o sistema desbloqueia essa conta para evitar que ela fique presa.
     */
    private function verifiesAccountBusyErrors()
    {
        try {
            $timezone = new \DateTimeZone(getenv('APP_TIMEZONE')) ?? null;
            $now = new \DateTime('now', $timezone);
        } catch (\Exception $e) {
            throw new HttpException(500, 'Timezone configurada incorretamente', null, [], 500);
        }
        $now_timestamp = $now->getTimestamp();
        $last_update_timestamp = $this->account->updated_at->getTimestamp();
        if ($now_timestamp - $last_update_timestamp > 15) {
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
     * Retorna o conjunto de notas para o cliente com a quantidade de cada nota que deve ser entregue para ele.
     * Quando não conseguir zerar o valor do saque retorna vazio.
     * 
     * @param array $available_bills Array com as notas disponíveis
     * @param int $value Valor do saque
     */
    private function getBillSet(array $available_bills, int $value)
    {
        $bill_set = [];
        $remaining = 0;
        $mutable_value = $value;
        $lastElement = end($available_bills);
        foreach ($available_bills as $key => $bill) {

            /** @param int $number_of_bills Obtem o valor máximo que se pode tirar do valor solicitado para saque */
            $number_of_bills = (int) floor($mutable_value / $bill);
            if ($number_of_bills > 0) {

                /** @param int $remaining O resto do valor após divisão */
                $remaining = $mutable_value % $bill;

                /** Se for a última nota, apenas verifica se conseguiu zerar */
                if ($bill === $lastElement) {
                    if ($remaining === 0) {
                        $bill_set[$bill] = $number_of_bills;
                        $mutable_value -= $number_of_bills * $bill;
                    } else {
                        $bill_set[$bill] = 0;
                    }
                    continue;
                }

                /** @param array $mutable_available_bills Array para manipulação dentro do foreach, sem alterar os valores originais */
                $mutable_available_bills = $available_bills;
                /** Agora vamos criar um novo conjunto de notas disponíveis partindo da nota atual */
                $new_available_bills = array_splice($mutable_available_bills, $key);
                /** E simular se vai ser possível zerar o valor solicitado para saque */
                $result = $this->getBillSet($new_available_bills, $remaining);

                if (!empty($result)) {
                    /** Se for possível zerar, salva esse valor na $bill_set, subtrai o valor do saque e continua */
                    $bill_set[$bill] = $number_of_bills;
                    $mutable_value -= $number_of_bills * $bill;
                    continue;
                } else if ($number_of_bills > 1) {
                    /** Se não for possível zerar, vai ir tentando diminuir a quantidade de notas pra tentar fechar esse valor */
                    $fallback_result = false;
                    for ($i = $number_of_bills - 1; $i > 0; $i--) {
                        /** Agora com uma nota a menos, diminuimos o valor do remaining */
                        $remaining_fallback = $mutable_value - ($i * $bill);
                        /** E simulamos novamente */
                        $result = $this->getBillSet($new_available_bills, $remaining_fallback);
                        if (!empty($result)) {
                            $bill_set[$bill] = $i;
                            $mutable_value -= $i * $bill;
                            $fallback_result = true;
                            break;
                        }
                    }
                    if ($fallback_result) {
                        continue;
                    }
                }
            }
            $bill_set[$bill] = 0;
        }

        if ($mutable_value === 0 && $remaining === 0) {
            return $bill_set;
        }

        return [];
    }

    /**
     * Retorna a soma das notas armazenadas em $this->returning_bills
     */
    private function sumCalculatedMoneyBills()
    {
        $valor_final = 0;
        if (empty($this->returning_bills)) {
            return 0;
        }

        foreach ($this->returning_bills as $bill => $quantity) {
            $valor_final += $bill * $quantity;
        }

        return $valor_final;
    }
}
