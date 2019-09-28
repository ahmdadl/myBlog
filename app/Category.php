<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['title'];

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }
}
