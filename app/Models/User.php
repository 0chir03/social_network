<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'phone',];
    protected $hidden = ['password',];

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }
}
