<?php

namespace App\Http\Services;

use App\Models\AccountType;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AccountTypeService
{
    public function customFindOrFail(int $id)
    {
        try {
            return AccountType::findOrFail($id);
        } catch (\Exception $e) {
            throw new HttpException(400, 'Tipo de conta inválido', null, [], 400);
        }
    }

    public function customFindOrFailByName(string $name)
    {
        $accountType = AccountType::where('name', $name)->first();
        if (empty($accountType)) {
            if (empty(AccountType::all()->toArray())) {
                throw new HttpException(500, 'Nenhum tipo de conta foi cadastrado no sistema', null, [], 500);
            }
            throw new HttpException(400, 'Tipo de conta inválido', null, [], 400);
        }
        return $accountType;
    }
}
