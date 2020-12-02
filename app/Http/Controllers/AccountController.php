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

/**
 * @group Contas bancárias
 *
 * API para gerenciar contas de usuários
 */
class AccountController extends Controller
{
    /**
	 * Listar
     *
     * Lista as contas do usuário informado.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @response scenario=success [
     *     {
     *         "id": 1
     *         "user_id": 1
     *         "account_type_id": 1
     *         "saldo": 50
     *         "tipo": "corrente"
     *     },
     *     {
     *         "id": 2
     *         "user_id": 1
     *         "account_type_id": 2
     *         "saldo": 50
     *         "tipo": "poupança"
     *     }
     * ]
     * @response status=400 scenario="user_not_found" {
     *    "message": "Usuário não encontrado."
     * }
     *
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $user_id)
    {
        $accounts = Account::where('user_id', $user_id)->paginate(50);
        return response()->json($accounts, 200);
    }

    /**
	 * Criar
     *
     * Cria uma conta para o usuário informado.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
	 * @bodyParam tipo string required Tipo da conta (corrente ou poupança). Example: poupança
     * @bodyParam saldo integer required Saldo inicial da conta. Example: 500
     * @response scenario=success {
     *  "id": 5,
     *  "message": "Conta criada com sucesso."
     * }
     * @response status=400 scenario="user_not_found" {
     *  "message": "Usuário não encontrado."
     * }
     * @response status=400 scenario="account_type_not_found" {
     *  "message": "Tipo de conta não encontrado."
     * }
     * @response status=400 scenario="user_has_account" {
     *  "message": "O usuário já possui uma conta do tipo informado"
     * }
     *
     * @param int $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

        return response()->json(['id' => $account->id, 'message' => 'Conta criada com sucesso'], 201);
    }

    /**
	 * Depositar
     *
     * Realiza o depósito do valor informado na conta informada.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @bodyParam valor integer required Valor do depósito. Example: 500
     * @response scenario=success {
     *  "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
     * }
     * @response status=400 scenario="user_not_found" {
     *  "message": "Usuário não encontrado."
     * }
     * @response status=400 scenario="account_not_found" {
     *  "message": "Conta não encontrada."
     * }
     * @response status=503 scenario="account_busy" {
     *  "message": "Caixa ocupado, por favor tente mais tarde"
     * }
     *
     * @param int $user_id
     * @param int $account_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deposit(int $user_id, int $account_id, Request $request)
    {
        $this->validate($request, [
            'valor' => 'required|integer|min:0'
        ]);

        (new UserService())->customFindOrFail($user_id);
        /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'deposit')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atm->initiateOperation();

        return response()->json(['message' => 'Depósito no valor de R$' . number_format($value, 2) . ' efetuado com sucesso'], 200);
    }

    /**
	 * Sacar
     *
     * Realiza o saque do valor informado na conta informada.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @bodyParam valor integer required Valor do saque. Example: 500
     * @response scenario=success {
     *  "message": "Saque no valor de R$ 500,00 efetuado com sucesso."
     * }
     * @response status=400 scenario="user_not_found" {
     *  "message": "Usuário não encontrado."
     * }
     * @response status=400 scenario="account_not_found" {
     *  "message": "Conta não encontrada."
     * }
     * @response status=400 scenario="transaction_type_not_found" {
     *  "message": "Erro. Tipo de transação não encontrada."
     * }
     * @response status=400 scenario="insuficient_funds" {
     *  "message": "Você não tem saldo suficiente para este saque"
     * }
     * @response status=400 scenario="wrong_amount" {
     *  "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100"
     * }
     * @response status=503 scenario="account_busy" {
     *  "message": "Caixa ocupado, por favor tente mais tarde"
     * }
     *
     * @param int $user_id
     * @param int $account_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function withdraw(int $user_id, int $account_id, Request $request)
    {
        $this->validate($request, [
            'valor' => 'required|integer|min:0'
        ]);

        (new UserService())->customFindOrFail($user_id);
         /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'withdraw')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atm->initiateOperation();

        return response()->json(['message' => 'Saque no valor de R$' . number_format($value, 2) . ' efetuado com sucesso'], 200);
    }

    /**
	 * Consultar extrato
     *
     * Consulta o extrato da conta informada
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @response scenario=success {
     *  "message": "oi"
     * }
     * @response status=400 scenario="user_not_found" {
     *  "message": "Usuário não encontrado."
     * }
     * @response status=400 scenario="account_not_found" {
     *  "message": "Conta não encontrada."
     * }
     *
     * @param int $user_id
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
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
