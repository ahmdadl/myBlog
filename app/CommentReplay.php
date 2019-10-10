<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReplay extends Model
{
    use RecordActivity;

    protected $fillable = ['userId', 'body'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function comment() : BelongsTo
    {
        return $this->belongsTo(Comment::class, 'commentId');
    }
}
