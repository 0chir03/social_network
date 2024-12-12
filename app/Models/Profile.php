<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'email', 'password', 'gender'
    ];

    protected $hidden = [
        'password'
    ];
}
