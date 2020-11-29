<?php

namespace App\Http\Controllers;

use App\Rules\CPFValidation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Helpers\DateHelper;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

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
        $user->save();

        return response()->json('Usuário criado com sucesso', 201);
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json('Usuário não encontrado', 204);
        }

        return response()->json($user, 200);
    }

    public function edit($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json('Usuário não encontrado', 204);
        }

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

        return response()->json('Usuário editado com sucesso', 200);
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json('Usuário não encontrado', 204);
        }

        $user->delete();

        return response()->json('Usuário removido com sucesso', 200);
    }
}
