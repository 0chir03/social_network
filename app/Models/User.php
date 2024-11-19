<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function message(): HasOne
    {
        return $this->hasOne(Message::class);
    }
}
