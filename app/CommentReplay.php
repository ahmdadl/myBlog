<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReplay extends Model
{
    protected $fillable = ['userId', 'body'];
}
