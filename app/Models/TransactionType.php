<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $guarded = ['name'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'transaction_type_id', 'id');
    }
}
