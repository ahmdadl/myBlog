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

    public function testItCanBeCompleted()
    {
        [$post, $task] = PostFactory::withTasks()->createBothTasks();

        $task->done = $task->complete();

        $this->assertTrue($task->done);
        $this->assertDatabaseHas('tasks', $task->attributesToArray());

        $task->done = $task->unComplete();
        $this->assertFalse($task->done);
        $this->assertDatabaseHas('tasks', $task->attributesToArray());
    }

    public function testItHasPath()
    {
        [$post, $task] = PostFactory::withTasks()->createBothTasks();

        $this->assertIsString($task->path());
        $this->assertEquals(
            $post->path() . '/tasks/' . $task->id,
            $task->path()
        );
    }
}
