<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'user';

    protected $fillable = [
        'name', 'email','username','delivery_zone_id','role','role_name','role_level','password','status'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
