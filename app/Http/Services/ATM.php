<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\TransactionType;

class ATM
{
    /** @var array $notas */
    private static $money_bills = [100, 50, 20];
    /** @var int $delay Tempo em milisegundos para refazer uma operação em caso de operações concorrentes */
    private static $delay = 1000;
    /** @var int $max_tries Número máximo de tentativas para refazer uma operação em caso de operações concorrentes */
    private static $max_tries = 5;
    /** @var Account $account */
    private $account;
    /** @var int $value */
    private $value;
    /** @var TransactionType $type */
    private $transaction_type;

    public function __construct(Account $account, TransactionType $transaction_type, int $value)
    {
        $this->account = $account;
        $this->transaction_type = $transaction_type;
        $this->value = $value;
    }

    /**
     * Initiate an operation on the client's account
     * @param int $retries
     * @return bool
     */
    public function initiateOperation(int $retries = 0)
    {
        try {
            return $this->mutateAccount();
        } catch (\Exception $e) {
            if ($e->getStatusCode() === 503 && $retries <= self::$max_tries) {
                $retries++;
                usleep(self::$delay * 1000);
                return $this->initiateOperation($retries);
            }
            abort($e->getStatusCode(), $e->getMessage());
        }
    }

    /**
     * Performs a withdraw/deposit
     * @return bool
     */
    private function mutateAccount()
    {
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
            abort($e->getStatusCode(), $e->getMessage());
        }

        (new TransactionService)->createTransaction($this->account, $this->transaction_type, $this->value);

        $this->setAccountBusy(false);
        return true;
    }

    /**
     * Sets the account to busy or not, depending the parameter passed, preventing concorrent requests
     * @param boolean $status
     * @return mixed
     */
    private function setAccountBusy(bool $status)
    {
        return Account::where('id', $this->account->id)->where('busy', !$status)->update(['busy' => $status]);
    }

    /**
     * Verifies if the operation user is trying to do is valid
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
     * Calculates the amount and the value of the money bills that the ATM should deliver
     * @param $value
     * @return array
     */
    private function calculateMoneyBills($value)
    {
        $final_bills = [];
        foreach (self::$money_bills as $bill) {
            /** If it is divisible by the current bill and its not divisible by any other bill within a higher priority */
            if ($bill % $value && empty($final_bills)) {
                return [$bill => $bill % $value];
            }
            /** If not, tries to return money bills based on a higher priority */
            $bill_quantity = ceil($bill / $value);
            if ($bill_quantity > 0) {
                /** Decrease the value */
                $value -= $bill_quantity * $bill;
                /** Adds to the final bills */
                $final_bills[$bill] = $bill_quantity;
            }
        }

        if ($value !== 0) {
            abort(400, 'Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100');
        }

        return $final_bills;
    }
}
