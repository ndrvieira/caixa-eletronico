<?php

namespace App\Http\Controllers;

use App\Http\Services\AccountService;
use App\Http\Services\AccountTypeService;
use App\Http\Services\ATM;
use App\Http\Services\UserService;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\TransactionType;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(int $user_id)
    {
        $accounts = Account::where('user_id', $user_id)->paginate(50);
        return response()->json($accounts, 200);
    }

    public function create(int $user_id, Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'saldo' => 'required|integer|min:0'
        ]);

        /** @var User $account */
        $user = (new UserService())->customFindOrFail($user_id);
        /** @var AccountType $account */
        $tipo = (new AccountTypeService())->customFindOrFailByName($request->tipo);

        (new AccountService())->validateCreation($user, $tipo);

        $account = new Account();
        $account->user_id = $user->id;
        $account->account_type_id = $tipo->id;
        $account->amount = $request->get('saldo');
        $account->save();

        return response()->json('Conta cadastrada com sucesso', 200);
    }

    public function deposit(int $user_id, int $account_id, Request $request)
    {
        $this->validate($request, [
            'valor' => 'required|integer|min:0'
        ]);

        /** @var User $account */
        $user = (new UserService())->customFindOrFail($user_id);
        /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'deposit')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atm->initiateOperation();

        return response()->json('Depósito no valor de R$' . number_format($value, 2) . ' efetuado com sucesso', 200);
    }

    public function withdraw(int $user_id, int $account_id, Request $request)
    {
        $this->validate($request, [
            'valor' => 'required|integer|min:0'
        ]);

        /** @var User $account */
        $user = (new UserService())->customFindOrFail($user_id);
         /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'withdraw')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atm->initiateOperation();

        return response()->json('Saque no valor de R$' . number_format($value, 2) . ' efetuado com sucesso', 200);
    }

    public function statement(int $user_id, int $account_id)
    {
        /** @var User $account */
        $user = (new UserService())->customFindOrFail($user_id);
        /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $transactions = $account->transactions()->paginate(50);
        return response()->json($transactions, 200);
    }
}
