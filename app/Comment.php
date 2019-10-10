<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    protected $fillable = ['userId', 'body'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($comment) {
            $comment->recordActivity('create_comment');
        });
    }

    public function recordActivity(string $msg) : ?Activity
    {
        if (!auth()->check()) {
            return null;
        }

        return $this->activity()->create([
            'userId' => auth()->id(),
            'postId' => $this->post->id,
            'info' => $msg
        ]);
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function activity() : MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
