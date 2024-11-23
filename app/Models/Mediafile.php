<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mediafile extends Model
{
    protected $fillable = ['user_id',
        'image_link',
        'music_link',
        'video_link',
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


}
