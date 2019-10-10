<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReplay extends Model
{
    protected $fillable = ['userId', 'body'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
