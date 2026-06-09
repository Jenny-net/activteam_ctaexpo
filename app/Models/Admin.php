<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'id',
        'email',
        'password',
        'profile_photo',
        'name',
        'phone',
        'password_reset_token',
        'token_expire_time'
    ];

    protected $hidden = [
        'password'
    ];
}
