<?php

namespace Tests\Feature;

use App\Task;
use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCannotCreatePosts()
    {
        $this->post('/api/posts', [])->assertRedirect('login');
    }

    public function testUserCanCreatePostWithTasks()
    {
        $this->withoutExceptionHandling();

        $post = PostFactory::ownedBy($this->signIn())->create('make');

        $tasks = factory(Task::class, 3)->make();

        $this->post('/api/posts', [
            'title' => $post->title,
            'body' => $post->body,
            'tasks' => $this->getTasks($tasks)
        ])
            ->assertStatus(201)
            ->assertSessionDoesntHaveErrors();

        $this->assertDatabaseHas('posts', $post->only('title'));
        $this->assertDatabaseHas('tasks', $tasks[2]->only('body'));

        $this->get($post->path())
            ->assertOk()
            ->assertSee($tasks[1]->body);
    }

    private function getTasks(object $tasks) : string
    {
        $output = [];
        foreach ($tasks as $task) {
            $output[] = ['body' => $task->body];
        }
        return json_encode($output);
    }
}
