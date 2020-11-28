<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class TransactionTypes
{
    const Deposit = 0;
    const Withdraw = 1;
}

class ATM
{
    /** @var array $notas */
    private static $money_bills = [100, 50, 20];
    /** @var int $delay */
    private static $delay = 2;
    /** @var Account $account */
    private $account;
    /** @var int $value */
    private $value;
    /** @var TransactionType $type */
    private $type;

    public function __construct(Account $account, int $value, TransactionType $type)
    {
        $this->account = $account;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Creates a transaction to lock operations in client's account
     * @return mixed
     */
    private function openTransaction()
    {
        return Transaction::create([
            'account_id' => $this->account->id,
            'transaction_type_id',
            'amount' => $this->value,
            'opened' => true,
        ]);
    }

    /**
     * Closes a transaction to unlock operations in client's account
     * @param Transaction $transaction
     */
    private function closeTransaction(Transaction $transaction)
    {
        $transaction->opened = false;
        $transaction->save();
    }

    /**
     * Search for opened transactions, when found throws an exception
     * @throws HttpException
     */
    public function findOpenedTransactions()
    {
        $open_transactions = Transaction::where('status', true)->where('account_id', $this->account->id)->limit(1);
        if ($open_transactions) {
            throw new HttpException('Caixa ocupado, tentando novamente');
        }
    }

    /**
     * Initiate an operation on the client's account
     * @param TransactionType $type
     * @param int $retries
     * @return bool
     */
    public function initiateOperation(TransactionType $type, int $retries = 0)
    {
        try {
            if ($type->id === TransactionTypes::Deposit) {
                return $this->deposit();
            } else if ($type->id === TransactionTypes::Withdraw) {
                return $this->withdraw();
            }
            throw new HttpException('Erro. Tipo de transação não encontrada.');
        } catch (\Exception $e) {
            if ($retries <= 5) {
                $retries++;
                sleep(self::$delay);
                return $this->initiateOperation($retries);
            }
            throw new HttpException('Caixa ocupado, por favor tente mais tarde.');
        }
    }

    /**
     * Performs a withdraw
     * @return bool
     */
    private function withdraw()
    {
        $this->findOpenedTransactions();
        $transaction = $this->openTransaction();
        $this->reloadAccountData();
        $this->operationIsValid();

        $this->account->amount += $this->value;
        $this->account->save();

        $this->closeTransaction($transaction);
        return true;
    }

    /**
     * Performs a deposit
     * @return bool
     */
    public function deposit()
    {
        $this->findOpenedTransactions();
        $transaction = $this->openTransaction();
        $this->reloadAccountData();
        $this->operationIsValid();

        $this->account->amount -= $this->value;
        $this->account->save();

        $this->closeTransaction($transaction);
        return true;
    }

    /**
     * Reload account data, fired before performing a withdraw/deposit
     */
    private function reloadAccountData()
    {
        $this->account = Account::find($this->account->id);
    }

    /**
     * Verifies if the operation user is trying to do is valid
     * @param TransactionType $type
     */
    private function operationIsValid()
    {
        if ($this->type->name === 'saque') {
            if ($this->account->amount < $this->value) {
                throw new HttpException('Você não tem saldo suficiente para este saque');
            }
        } else if ($this->type->name === 'deposito') {
            if (empty($this->calculateMoneyBills($this->value))) {
                throw new HttpException('Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100');
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
        foreach (ATM::$money_bills as $bill) {
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
            throw new HttpException('Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100');
        }

        return $final_bills;
    }
}
