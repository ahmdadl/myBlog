<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        $this->morphTo();
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}