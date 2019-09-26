<?php declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
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
}
