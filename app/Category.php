<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    protected $fillable = ['title'];

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    public function activity() : MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
