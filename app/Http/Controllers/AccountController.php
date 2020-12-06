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
     * Lista as contas de um usuário.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @response scenario=Sucesso [
     *     {
     *         "id": 1,
     *         "user_id": 1,
     *         "account_type_id": 1,
     *         "saldo": 50,
     *         "tipo": "corrente",
     *     },
     *     {
     *         "id": 2,
     *         "user_id": 1,
     *         "account_type_id": 2,
     *         "saldo": 50,
     *         "tipo": "poupança",
     *     }
     * ]
     * @response status=400 scenario="Usuário não encontrado" {
     *     "error": [
     *         "code": 400,
     *         "message": "Usuário não encontrado"
     *     ]
     * }
     *
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $user_id)
    {
        (new UserService())->customFindOrFail($user_id);

        $accounts = Account::where('user_id', $user_id)->get();
        return response()->json($accounts, 200);
    }

    /**
	 * Criar
     *
     * Cria uma conta para o usuário informado com um saldo inicial. Tipos aceitos: "corrente" e "poupança".
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
	 * @bodyParam tipo string required Tipo da conta (corrente ou poupança). Example: poupança
     * @bodyParam saldo integer Saldo inicial da conta, somente valores positivos, se omitido será 0. Example: 500
     * @response scenario=Sucesso {
     *    "id": 5,
     *    "message": "Conta criada com sucesso."
     * }
     * @response status=422 scenario="Dados inválidos" {
     *     "error": [
     *         "code": 422,
     *         "message": [
     *             "tipo": [
     *                 "O campo tipo é obrigatório."
     *             ]
     *         ]
     *     ]
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "error": [
     *         "code": 400,
     *         "message": "Usuário não encontrado"
     *     ]
     * }
     * @response status=400 scenario="Tipo de conta inexistente" {
     *     "error": [
     *         "code": 400,
     *         "message": "Tipo de conta não encontrado."
     *     ]
     * }
     * @response status=409 scenario="Usuário já possui conta deste tipo" {
     *     "error": [
     *         "code": 409,
     *         "message": "O usuário já possui uma conta do tipo informado."
     *     ]
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
            'tipo' => [
                'required',
                'string',
                'regex:/^corrente$|^poupança$/',
            ],
            'saldo' => 'integer|between:0,9223372036854775807'
        ]);

        /** @var User $user */
        $user = (new UserService())->customFindOrFail($user_id);
        /** @var AccountType $tipo */
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
     * Realiza o depósito de um determinado valor na conta de um usuário.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @bodyParam valor integer required Valor do depósito. Example: 500
     * @response scenario=Sucesso {
     *     "saldo": 50,
     *     "message": "Depósito no valor de R$ 500,00 efetuado com sucesso."
     * }
     * @response status=422 scenario="Dados inválidos" {
     *     "error": [
     *         "code": 422,
     *         "message": [
     *             "valor": [
     *                 "O campo valor é obrigatório."
     *             ]
     *         ]
     *     ]
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "error": [
     *         "code": 400,
     *         "message": "Usuário não encontrado"
     *     ]
     * }
     * @response status=400 scenario="Conta não encontrada" {
     *     "error": [
     *         "code": 400,
     *         "message": "Conta não encontrada."
     *     ]
     * }
     * @response status=500 scenario="Tipo de transação não encontrada" {
     *     "error": [
     *         "code": 500,
     *         "message": "Tipo de transação não encontrada."
     *     ]
     * }
     * @response status=503 scenario="Caixa ocupado" {
     *     "error": [
     *         "code": 503,
     *         "message": "Caixa ocupado, por favor tente mais tarde."
     *     ]
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
            'valor' => 'required|integer|min:1'
        ]);

        (new UserService())->customFindOrFail($user_id);
        /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'deposit')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atmResponse = $atm->initiateOperation();

        return response()->json([
            'saldo' => $atmResponse->account->amount,
            'message' => 'Depósito no valor de R$' . number_format($value, 2, ',', '.') . ' efetuado com sucesso'
        ], 200);
    }

    /**
	 * Sacar
     *
     * Realiza o saque de um determinado valor na conta de um usuário, e retorna o saldo e 
     * a quantidade de cada nota que deve retornar
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @bodyParam valor integer required Valor do saque. Example: 150
     * @response scenario=Sucesso {
     *     "notas" => [
     *        "100": 1,
     *        "50": 1,
     *        "20": 0
     *     ],
     *     "saldo": 50,
     *     "message": "Saque no valor de R$ 150,00 efetuado com sucesso."
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "error": [
     *         "code": 400,
     *         "message": "Usuário não encontrado"
     *     ]
     * }
     * @response status=400 scenario="Conta não encontrada" {
     *     "error": [
     *         "code": 400,
     *         "message": "Conta não encontrada."
     *     ]
     * }
     * @response status=500 scenario="Tipo de transação não encontrada" {
     *     "error": [
     *         "code": 500,
     *         "message": "Tipo de transação não encontrada."
     *     ]
     * }
     * @response status=400 scenario="Saldo insuficiente" {
     *     "error": [
     *         "code": 400,
     *         "message": "Você não tem saldo suficiente para este saque."
     *     ]
     * }
     * @response status=400 scenario="Valor incorreto para saque" {
     *     "error": [
     *         "code": 400,
     *         "message": "Valor solicitado não disponível para saque. Selecione um valor multiplo de 20, 50 e 100."
     *     ]
     * }
     * @response status=503 scenario="Caixa ocupado" {
     *     "error": [
     *         "code": 503,
     *         "message": "Caixa ocupado, por favor tente mais tarde."
     *     ]
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
            'valor' => 'required|integer|min:1'
        ]);

        (new UserService())->customFindOrFail($user_id);
         /** @var Account $account */
        $account = (new AccountService())->customFindOrFail($account_id);
        $value = (int) $request->get('valor');

        $transactionType = TransactionType::where('name', 'withdraw')->first();

        $atm = new ATM($account, $transactionType, $value);
        $atmResponse = $atm->initiateOperation();

        return response()->json([
            'notas' => $atmResponse->returning_bills,
            'saldo' => $atmResponse->account->amount,
            'message' => 'Saque no valor de R$' . number_format($value, 2, ',', '.') . ' efetuado com sucesso'
        ], 200);
    }

    /**
	 * Consultar extrato
     *
     * Consulta o extrato da conta de um usuário.
	 *
     * @queryParam user_id integer required Código do usuário Example: 1
     * @queryParam account_id integer required Código da conta do usuário Example: 1
     * @response scenario=Sucesso {
     *     "current_page": 1,
     *     "data": [
     *         {
     *             "id": 1,
     *             "account_id": 1,
     *             "transaction_type_id": 1,
     *             "created_at": "2020-12-02T02:07:02.000000Z",
     *             "updated_at": "2020-12-02T02:07:02.000000Z",
     *             "valor": 50,
     *             "tipo": "Depósito"
     *         },
     *         {
     *             "id": 2,
     *             "account_id": 1,
     *             "transaction_type_id": 1,
     *             "created_at": "2020-12-02T02:07:07.000000Z",
     *             "updated_at": "2020-12-02T02:07:07.000000Z",
     *             "valor": 50,
     *             "tipo": "Depósito"
     *         },
     *     ],
     *     "first_page_url": "http://localhost/api/v1/users/1/accounts/1/statement?page=1",
     *     "from": 1,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/v1/users/1/accounts/1/statement?page=1",
     *     "next_page_url": null,
     *     "path": "http://localhost/api/v1/users/1/accounts/1/statement",
     *     "per_page": 50,
     *     "prev_page_url": null,
     *     "to": 20,
     *     "total": 20
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "error": [
     *         "code": 400,
     *         "message": "Usuário não encontrado"
     *     ]
     * }
     * @response status=400 scenario="Conta não encontrada" {
     *     "error": [
     *         "code": 400,
     *         "message": "Conta não encontrada."
     *     ]
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
