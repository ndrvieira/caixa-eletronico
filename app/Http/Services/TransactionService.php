<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;

class TransactionService
{
    public function createTransaction(Account $account, TransactionType $transaction_type, int $value)
    {
        $transaction = new Transaction();
        $transaction->account_id = $account->id;
        $transaction->transaction_type_id = $transaction_type->id;
        $transaction->amount = $value;
        $transaction->save();
        return $transaction;
    }
}
