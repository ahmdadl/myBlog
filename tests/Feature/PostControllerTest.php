<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testAnyUserCanViewAllPosts()
    {
        $post = PostFactory::create();

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function testPostCanBeViewdBySlug()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->get($post->path())
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    public function testGuestCannotCreatePost()
    {
        $this->get('/posts/create')->assertRedirect('login');

        $this->post('/posts', [])->assertRedirect('login');
    }

    public function testAuthrizedUserCanCreatePost()
    {
        $this->withoutExceptionHandling();

        $post = PostFactory::ownedBy($this->signIn())->create('make');

        $this->get('/posts/create')
            ->assertStatus(200)
            ->assertViewIs('post.create');

        $this->post(
            '/posts',
            $post->attributesToArray()
        )->assertRedirect($post->path());

        $this->assertDatabaseHas('posts', $post->attributesToArray());

        $this->get($post->path())
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    public function testGuestCannotUpdatePost()
    {
        $post = PostFactory::create('raw');

        $this->get('/posts/edit')->assertRedirect('login');

        $this->patch('/posts/' . $post['slug'], $post)->assertRedirect('login');

        $this->assertDatabaseMissing('posts', $post);
    }

    public function testUserWithoutPermissionCannotUpdatePost()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->patch($post->path(), $post->attributesToArray())
            ->assertStatus(403);
    }

    public function testUserCanUpdatePost()
    {
        [$admin, $user] = UserFactory::createWithAdmin();

        // give user permission to update post
        $admin->givePermTo($user, User::DELETE_POSTS);

        // create post with given user
        $post = PostFactory::ownedBy($this->signIn($user))->create();

        // try to update post
        $this->patch(
            $post->path(),
            $post->attributesToArray(),
            ['HTTP_REFERER' => $post->path()]
            )->assertRedirect($post->path());
        
        $this->assertDatabaseHas('posts', $post->toArray());

        $this->get($post->path())
            ->assertViewIs('post.show')
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    public function testGusetCannotDeletePost()
    {
        $post = PostFactory::ownedBy(UserFactory::create())->create();

        $this->delete($post->path())->assertRedirect('login');
    }

    public function testUserWithoutPermissionCannotDeletePost()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->delete($post->path())->assertStatus(403);
    }
}