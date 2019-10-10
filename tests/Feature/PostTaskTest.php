<?php

namespace Tests\Feature;

use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCannotAddTask()
    {
        [$post, $task] = PostFactory::withTasks()
            ->createBothTasks('make');

        // $post->addTask()
    }
}
