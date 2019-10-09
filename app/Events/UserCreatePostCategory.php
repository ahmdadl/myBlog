<?php

namespace App\Events;

use App\Post;
use App\PostCategory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreatePostCategory
{
    use Dispatchable, SerializesModels;

    public $postCat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PostCategory $postCat)
    {
        $this->postCat = $postCat;
    }
}
