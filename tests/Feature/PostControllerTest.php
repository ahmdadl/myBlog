<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
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
}
