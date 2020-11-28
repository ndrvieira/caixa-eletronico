<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $guarded = ['name'];

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'type_id', 'id');
    }
}
