<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class AccountType extends Model
{
    protected $guarded = ['name'];

    public function accounts()
    {
        return $this->belongsTo('App\Models\Account', 'account_type_id', 'id');
    }
}
