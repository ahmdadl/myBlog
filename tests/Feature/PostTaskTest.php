<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
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

        $this->post(
            $post->path() . '/tasks',
            []
        )->assertRedirect('login');

        $this->assertDatabaseMissing('tasks', $task->toArray());
    }

    public function testUserWithPermissionCanCreateTask()
    {
        $admin = UserFactory::admin();
        $admin->givePermTo(
            $user = UserFactory::create(),
            User::ADD_CATEGORIES
        );

        [$post, $task] = PostFactory::ownedBy($this->signIn($user))
            ->withTasks()
            ->createBothTasks('make');
        
        $this->post(
            $post->path() . '/tasks',
            $task->only('body'),
            $this->setReferer($post->path())
        )->assertRedirect($post->path());

        $this->assertDatabaseHas('tasks', $task->only('body'));
    }

    public function testUserWithoutPermissionCannotAddTask()
    {
        [$post, $task] = PostFactory::ownedBy($this->signIn())
            ->withTasks()
            ->createBothTasks('make');
        
        $this->post(
            $post->path() . '/tasks',
            $task->only('body')
        )->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $task->only('body'));
    }

    public function testTaskValidationRules()
    {
        $admin = UserFactory::admin();
        $admin->givePermTo(
            $user = UserFactory::create(),
            User::ADD_CATEGORIES
        );

        [$post, $task] = PostFactory::ownedBy($this->signIn($user))
            ->withTasks()
            ->createBothTasks('make');
        
        // taks requires body
        $this->post(
            $post->path() . '/tasks',
            []
        )->assertSessionHasErrors('body');

        // task minium length
        $this->post(
            $post->path() . '/tasks',
            ['body' => 'asd']
        )->assertSessionHasErrors('body');

        // task max length
        $this->post(
            $post->path() . '/tasks',
            ['body' => $post->body]
        )->assertSessionHasErrors('body');
    }
}
