<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int account_type_id
 * @property int amount
 * @property int busy
 */
class Account extends Model
{
    protected $guarded = ['user_id', 'account_type_id', 'amount', 'busy'];

    protected $hidden = [
        'amount',
        'busy',
        'accountType'
    ];

    protected $appends = ['saldo', 'tipo'];

    public function getSaldoAttribute()
    {
        return $this->amount;
    }

    public function getTipoAttribute()
    {
        return $this->accountType->name;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function accountType()
    {
        return $this->hasOne('App\Models\AccountType', 'id', 'account_type_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'account_id', 'id');
    }
}
