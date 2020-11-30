<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int account_id
 * @property int transaction_type_id
 * @property int amount
 */
class Transaction extends Model
{
    protected $guarded = ['account_id', 'transaction_type_id', 'amount'];

    protected $hidden = [
        'amount', 'transactionType'
    ];

    protected $appends = ['valor', 'tipo'];

    public function getValorAttribute()
    {
        return $this->amount;
    }

    public function getTipoAttribute()
    {
        return $this->transactionType->name === 'deposit' ? 'Depósito' : 'Saque';
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function transactionType()
    {
        return $this->hasOne('App\Models\TransactionType', 'id', 'transaction_type_id');
    }
}
