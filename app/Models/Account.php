<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['user_id',
                           'first_name',
                           'last_name',
                           'date_of_birth',
                           'marital_status',
                           'locality',
                           'career',
                           'hobby',
             ];

    public function photo(): HasOne
    {
        return $this->hasOne(Photo::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    public function message(): HasOne
    {
        return $this->hasOne(Message::class);
    }


}
