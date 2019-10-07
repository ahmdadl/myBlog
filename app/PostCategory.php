<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    
    public function activity()
    {
        return $this->morphTo();
    }
}
