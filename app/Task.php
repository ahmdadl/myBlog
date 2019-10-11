<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use RecordActivity;

    protected $fillable = ['userId', 'body'];

    protected $casts = [
        'done' => 'boolean'
    ];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function complete(bool $done = true) : bool
    {
        $this->done = $done;
        $this->update();

        return $done;
    }

    public function unComplete() : bool
    {
        return $this->complete(false);
    }

    public function path() : string
    {
        return $this->post->path() . '/tasks/' . $this->id;
    }
}
