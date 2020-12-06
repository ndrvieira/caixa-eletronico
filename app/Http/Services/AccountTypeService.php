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
            throw new HttpException(400, 'Tipo de conta não encontrado', null, [], 400);
        }
    }

    public function customFindOrFailByName(string $name)
    {
        try {
            return AccountType::where('name', $name)->first();
        } catch (\Exception $e) {
            throw new HttpException(400, 'Tipo de conta não encontrado', null, [], 400);
        }
    }
}
