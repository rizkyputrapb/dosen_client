<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    public $table = "admin";

    protected $fillable = [
        'username',
        'password'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function setPasswordAttribute($val)
    {
        return $this->attributes['password'] = bcrypt($val);
    }
}
