<?php

namespace App;

use App\Events\UserCreatePostCategory;
use App\Listeners\PostCategoryCreated;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    // protected $table = 'post_categories';

    // protected $dispatchesEvents = [
    //     'created' => UserCreatePostCategory::class,
    //     'updated' => UserCreatePostCategory::class
    // ];

    public function activity()
    {
        return $this->morphTo();
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     self::created(function ($post) {
    //         dd($post);
    //         dd('adsa asdas dsad');
    //         $post->recordActivity('create_category');
    //     });

    //     self::updated(function (Post $post) {
    //         $post->recordActivity('update_category');
    //     });
    // }

    // public function recordActivity(string $msg) : ?Activity
    // {
    //     if (!auth()->check()) {
    //         return null;
    //     }

    //     return $this->activity()->create([
    //         'userId' => auth()->id(),
    //         'postId' => $this->id,
    //         'info' => $msg
    //     ]);
    // }
}
