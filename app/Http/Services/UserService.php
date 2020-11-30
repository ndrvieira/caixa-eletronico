<?php

namespace App\Http\Services;

use App\Models\AccountType;
use App\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    public function customFindOrFail(int $id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $e) {
            throw new HttpException(400, 'Usuário não encontrado');
        }
    }

    public function hasAccountOfType(User $user, AccountType $accountType)
    {
        $hasAccount = $user->whereHas('accounts', function($query) use ($accountType) {
           $query->where('account_type_id', $accountType->id);
        })->first();
        return !empty($hasAccount);
    }
}
