<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['userId', 'body'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
