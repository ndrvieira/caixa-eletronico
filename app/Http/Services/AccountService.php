<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\AccountType;
use App\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AccountService
{
    public function customFindOrFail(int $id)
    {
        try {
            return Account::findOrFail($id);
        } catch (\Exception $e) {
            throw new HttpException(400, 'Tipo de conta não encontrado');
        }
    }

    /**
     * Verifica se o usuário já não possui uma conta do mesmo tipo cadastrada
     * 
     * @param User $user
     * @param AccountType $accountType
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function validateCreation(User $user, AccountType $accountType)
    {
        if ((new UserService())->hasAccountOfType($user, $accountType)) {
            throw new HttpException(409, 'O usuário já possui uma conta do tipo ' . $accountType->name, null, [], 409);
        }
    }
}
