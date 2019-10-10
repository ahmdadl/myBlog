<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Comment extends Model
{
    use RecordActivity;

    protected $fillable = ['userId', 'body'];

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
