<?php

namespace App;

use App\Helpers\DateHelper;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property string name
 * @property Date birth_date
 * @property string cpf
 * @property string api_token
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth_date', 'cpf'
    ];

    protected $hidden = [
        'name',
        'birth_date',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['nome', 'data_nascimento'];

    public function getNomeAttribute()
    {
        return $this->name;
    }

    public function getDataNascimentoAttribute()
    {
        return DateHelper::convertToBrFormat($this->birth_date);
    }

    /**
     * Get the account record associated with the user.
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'user_id', 'id');
    }
}
