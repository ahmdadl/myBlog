<?php declare(strict_types = 1);

namespace App;

use App\Events\UserCreatePostCategory;
use App\Listeners\PostCategoryCreated;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Post extends Model
{
    use RecordActivity;
    
    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::created(function (Post $post) {
    //         $post->recordActivity('create_post');
    //     });

    //     self::updated(function (Post $post) {
    //         $post->recordActivity('update_post');
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
        return $this->belongsToMany(
            Category::class, 
            'post_categories'
        );
    }

    public function addCategory(int $catId)
    {
        $this->categories()->attach($catId);

        $this->recordActivity('create_post_category');
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

    /**
     * add new users to post members to allow them edit it
     *
     * @param User $user
     * @return void
     */
    public function invite(User $user) : void
    {
        $this->recordActivity('add_member');
        
        $this->members()->attach($user);
    }

    public function activity() : MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function activities() : HasMany
    {
        return $this->hasMany(Activity::class, 'postId')->latest();
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'postId');
    }

    public function comment(string $body)
    {
        // $this->recordActivity('create_comment');

        return $this->comments()->create([
            'userId' => auth()->id(),
            'body' => $body
        ]);
    }
}
