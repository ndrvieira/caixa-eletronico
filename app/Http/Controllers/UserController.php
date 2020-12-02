<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Rules\CPFValidation;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;

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
	 */
    public function index()
    {
        return response()->json(User::paginate(50));
    }

    /**
	 * Criar
	 *
	 * @bodyParam nome string required Nome do usuário. Example: André
     * @bodyParam cpf string required CPF do usuário com pontuação. Example: 959.357.500-66
     * @bodyParam data_nascimento string required Data no formato: d/m/Y. Example: 01/01/2001
     * @response scenario=Sucesso {
     *  "id": 4,
     *  "message": "Usuário criado com sucesso."
     * }
     * @response status=400 scenario="Dados inválidos" {
     *    "cpf": [
     *       "O cpf informado é inválido."
     *    ]
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
        } catch (\Exception $e) {
            dd($e);
            abort(400, 'O CPF informado já foi registrado em outro usuário.');
        }

        return response()->json(['id' => $user->id, 'message' => 'Usuário criado com sucesso'], 201);
    }

    /**
	 * Buscar
	 *
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *  "id": 4,
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *  "message": "Usuário não encontrado"
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
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *  "user": 4,
     *  "message": "Usuário editado com sucesso",
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *  "message": "Usuário não encontrado"
     * }
     * @response status=400 scenario="Dados inválidos" {
     *    "nome": [
     *       "O nome informado é inválido."
     *    ]
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
        $user->save();

        return response()->json(['user' => $user, 'message' => 'Usuário editado com sucesso'], 200);
    }

    /**
	 * Deletar
	 *
     * @queryParam user_id integer required Código do usuário. Example: 1
     * @response scenario=Sucesso {
     *  "message": "Usuário removido com sucesso",
     * }
     * @response status=400 scenario="Usuário não encontrado" {
     *  "message": "Usuário não encontrado"
     * }
	 */
    public function delete($user_id)
    {
        $user = (new UserService())->customFindOrFail($user_id);
        $user->delete();

        return response()->json(['message' => 'Usuário removido com sucesso'], 200);
    }
}
