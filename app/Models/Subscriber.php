<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subscriber extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['user_id', 'account_id',];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
