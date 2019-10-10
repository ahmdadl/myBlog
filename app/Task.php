<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['userId', 'body'];
    
    protected $casts = [
        'done' => 'boolean'
    ];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}
