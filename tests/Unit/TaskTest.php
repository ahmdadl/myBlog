<?php

namespace Tests\Unit;

use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testItBelongsToPost()
    {
        [$post, $task] = PostFactory::withTasks()->createBothTasks();

        $this->assertEquals($task->post->id, $post->id);
    }
}
