<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class AccountType extends Model
{
    protected $guarded = ['name'];

    protected $hidden = [
        'name',
    ];

    protected $appends = ['nome'];

    public function getNomeAttribute()
    {
        return $this->name;
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'account_type_id', 'id');
    }
}
