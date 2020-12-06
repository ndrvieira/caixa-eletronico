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
            throw new HttpException(404, 'Usuário não encontrado', null, [], 404);
        }
    }

    public function hasAccountOfType(User $user, AccountType $accountType)
    {
        $userAccounts = $user->accounts()->get();
        foreach ($userAccounts as $account) {
            if ($account->account_type_id === $accountType->id) {
                return true;
            }
        }
        return false;
    }
}
