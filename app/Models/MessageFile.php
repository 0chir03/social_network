<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MessageFile extends Model
{
    protected $fillable = ['message_id', 'file_link'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

}
