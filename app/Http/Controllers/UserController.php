<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function login()
    {
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user = new User();
        $user->name = 'teste';
    }

    public function find($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function edit(User $user)
    {
        $user->name = 'teste';
    }

    public function delete(User $user)
    {
        return response()->json($user->delete());
    }
}
