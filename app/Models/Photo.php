<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Photo extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['account_id', 'photo_link',];

    public function photo(): HasOne
    {
        return $this->hasOne(Photo::class);
    }
}
