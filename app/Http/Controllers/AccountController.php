<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $account = new Account();
        $account->user_id = $request->user_id;
        $account->account_type_id = $request->account_type_id;
        $account->amount = $request->amount;
        $account->save();

        return response()->json('Conta cadastrada com sucesso', 200);
    }

    public function deposit(Request $request)
    {
        $accountId = $request->account_id;
        $account = Account::findOrFail($accountId);
        $value = $request->value;
        $atm = new ATM($account, $value, 0);

        return response()->json('Depósito no valor de R$' . number_format($value, 2) . ' efetuado com sucesso', 200);
    }

    public function withdraw(Request $request)
    {
        $accountId = $request->account_id;
        $account = Account::findOrFail($accountId);
        $value = $request->value;
        $atm = new ATM($account, $value, 1);

        return response()->json('Saque no valor de R$' . number_format($value, 2) . ' efetuado com sucesso', 200);
    }
}
