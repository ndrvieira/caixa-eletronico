<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Rules\CPFValidation;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;
use Illuminate\Database\QueryException;

/**
 * @group Usuários
 *
 * API para gerenciar usuários
 */
class UserController extends Controller
{
    /**
	 * Listar
     * 
     * Lista todos os usuários cadastrados no sistema
     * 
     * @response scenario=Sucesso {
     *     "current_page": 1,
     *     "data": [
     *         {
     *             "id": 1,
     *             "cpf": "306.045.290-31",
     *             "created_at": "2020-12-02T01:39:47.000000Z",
     *             "updated_at": "2020-12-02T01:39:47.000000Z",
     *             "nome": "André",
     *             "data_nascimento": "01/01/1992"
     *         },
     *         {
     *             "id": 2,
     *             "cpf": "148.078.190-89",
     *             "created_at": "2020-12-02T01:42:47.000000Z",
     *             "updated_at": "2020-12-02T01:42:47.000000Z",
     *             "nome": "Pedro",
     *             "data_nascimento": "01/01/1993"
     *         },
     *     ],
     *     "first_page_url": "http://localhost/api/v1/users?page=1",
     *     "from": 1,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/v1/users?page=1",
     *     "next_page_url": null,
     *     "path": "http://localhost/api/v1/users",
     *     "per_page": 50,
     *     "prev_page_url": null,
     *     "to": 1,
     *     "total": 1
     * }
	 */
    public function index()
    {
        return response()->json(User::paginate(50));
    }

    /**
	 * Criar
     * 
     * Cria um usuário no sistema
	 *
	 * @bodyParam nome string required Nome do usuário. Example: André
     * @bodyParam cpf string required CPF do usuário com pontuação. Example: 959.357.500-66
     * @bodyParam data_nascimento string required Data no formato: d/m/Y. Example: 01/01/2001
     * @response scenario=Sucesso {
     *     "id": 4,
     *     "message": "Usuário criado com sucesso."
     * }
     * @response status=400 scenario="Dados inválidos" {
     *     "cpf": [
     *        "O cpf informado é inválido."
     *     ]
     * }
     * @response status=400 scenario="CPF já existente" {
     *     "message": "O CPF informado já foi registrado em outro usuário."
     * }
     * @response status=400 scenario="Erro na aplicação" {
     *     "message": "Erro ao cadastrar usuário"
     * }
	 */
    public function create(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:100',
            'cpf' => new CPFValidation,
            'data_nascimento' => 'required|date_format:d/m/Y'
        ]);

        $user = new User();
        $user->name = $request->get('nome');
        $user->cpf = $request->get('cpf');
        $user->birth_date = DateHelper::convertToDbFormat($request->get('data_nascimento'));
        try {
            $user->save();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                abort(400, 'O CPF informado já foi registrado em outro usuário.');
            }
            abort(400, 'Erro ao cadastrar usuário.');
        } catch (\Exception $e) {
            abort(400, 'Erro ao cadastrar usuário.');
        }

        return response()->json(['id' => $user->id, 'message' => 'Usuário criado com sucesso'], 201);
    }

    /**
	 * Buscar
     * 
     * Busca um usuário específico no sistema através do seu id
	 *
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *     "id": 1,
     *     "cpf": "306.045.290-31",
     *     "created_at": "2020-12-02T01:39:47.000000Z",
     *     "updated_at": "2020-12-02T01:39:47.000000Z",
     *     "nome": "André",
     *     "data_nascimento": "01/01/1992"
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "message": "Usuário não encontrado"
     * }
	 */
    public function show(int $user_id)
    {
        $user = (new UserService())->customFindOrFail($user_id);
        return response()->json($user, 200);
    }

    /**
	 * Editar
     * 
     * Edita um usuário no sistema
	 *
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *     "user": {
     *        "id": 1,
     *        "cpf": "306.045.290-31",
     *        "created_at": "2020-12-02T01:39:47.000000Z",
     *        "updated_at": "2020-12-02T01:39:47.000000Z",
     *        "nome": "André",
     *        "data_nascimento": "01/01/1992"
     *     },
     *     "message": "Usuário editado com sucesso",
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "message": "Usuário não encontrado"
     * }
     * @response status=400 scenario="Dados inválidos" {
     *     "nome": [
     *        "O nome informado é inválido."
     *     ]
     * }
     * @response status=400 scenario="Erro na aplicação" {
     *     "message": "Erro ao cadastrar usuário"
     * }
	 */
    public function edit(int $user_id, Request $request)
    {
        $user = (new UserService())->customFindOrFail($user_id);

        $this->validate($request, [
            'nome' => 'max:100',
            'data_nascimento' => 'date_format:d/m/Y'
        ]);

        if (!empty($request->get('nome'))) {
            $user->name = $request->get('nome');
        }
        if (!empty($request->get('data_nascimento'))) {
            $user->birth_date = DateHelper::convertToDbFormat($request->get('data_nascimento'));
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            abort(400, 'Erro ao cadastrar usuário.');
        }

        return response()->json(['user' => $user, 'message' => 'Usuário editado com sucesso'], 200);
    }

    /**
	 * Deletar
     * 
     * Deleta um usuário do sistema
	 *
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *     "message": "Usuário removido com sucesso",
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *     "message": "Usuário não encontrado"
     * }
	 */
    public function delete($user_id)
    {
        $user = (new UserService())->customFindOrFail($user_id);
        $user->delete();

        return response()->json(['message' => 'Usuário removido com sucesso'], 200);
    }
}
