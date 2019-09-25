<?php declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'img'];

    protected $primaryKey = 'slug';

    public function getMiniBodyAttribute() : string
    {
        return Str::substr($this->body, 0, 250);
    }

    public function path() : string
    {
        return '/posts/' . $this->slug;
    }
}
