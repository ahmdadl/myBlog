<?php declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $guarded = [];

    public function getMiniBodyAttribute() : string
    {
        return Str::substr($this->body, 0, 250);
    }

    public function getSlugAttribute(string $slug) : string
    {
        return $slug;
    }

    /**
     * Get the route key for the model
     *
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function path() : string
    {
        return '/posts/' . $this->slug;
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }
    
    public function members() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'post_members',
            'postId',
            'userId'
        )->withTimestamps();
    }

    public function invite(User $user) : void
    {
        $this->members()->attach($user);
    }
}
