<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int account_id
 * @property int transaction_type_id
 * @property int amount
 * @property boolean opened
 * @property DateTime date
 */
class Transaction extends Model
{
    protected $guarded = ['account_id', 'transaction_type_id', 'amount', 'opened', 'date'];

    public function account()
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function type()
    {
        return $this->hasOne('App\Models\TransactionType', 'type_id', 'id');
    }
}
