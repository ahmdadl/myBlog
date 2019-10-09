<?php

namespace App\Listeners;

use App\Events\UserCreatePostCategory;
use App\PostCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostCategoryCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreatePostCategory $event)
    {
        dd($event);
        // sleep(10);
    }
}
