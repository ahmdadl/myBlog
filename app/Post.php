<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'img'];

    public function getMiniBodyAttribute() : string
    {
        return Str::substr($this->body, 0, 250);
    }
}
