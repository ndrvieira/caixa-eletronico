<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int account_type_id
 * @property int amount
 */
class Account extends Model
{
    protected $guarded = ['user_id', 'account_type_id', 'amount'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'account_id', 'id');
    }
}
