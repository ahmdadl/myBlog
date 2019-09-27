<?php

namespace Tests\Feature;

use App\Post;
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
        $this->guestUpdateOrDeletePost('patch');
    }

    public function testGuestCannotDeletePost()
    {
        $this->guestUpdateOrDeletePost('delete');
    }

    public function testUserWithoutPermissionCannotUpdateOrDeletePost()
    {
        $post = PostFactory::ownedBy(UserFactory::create())->create();

        $this->actingAs(UserFactory::create())
            ->patch($post->path(), $post->attributesToArray())
            ->assertStatus(403);
        
        $this->actingAs(UserFactory::create())
            ->delete($post->path())
            ->assertStatus(403);
    }

    public function testPostOwnerCanUpdatePostWithoutPermission()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->patch(
            $post->path(),
            $post->attributesToArray(),
            ['HTTP_REFERER' => $post->path()]
            )->assertRedirect($post->path());
        
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function testPostOwnerCanDeletePostWithoutPermission()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->delete(
            $post->path(),
            $post->attributesToArray(),
            ['HTTP_REFERER' => $post->path()]
            )->assertRedirect('/posts');
        
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    public function testUserWithPermissionCanUpdateOtheresPost()
    {
        [$user, $post] = $this->userUpdateOrDeletePost('update');

        // try to update post
        $this->actingAs($user)
            ->patch(
                $post->path(),
                ['title' => $post->title . 'asd'],
                ['HTTP_REFERER' => $post->path()]
            )->assertRedirect($post->path());
        
        $this->assertDatabaseHas('posts', $post->toArray());

        $this->get($post->path())
            ->assertViewIs('post.show')
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    public function testUserWithPermissionCanDeleteOtheresPost()
    {
        [$user, $post] = $this->userUpdateOrDeletePost('delete');

        // try to update post
        $this->actingAs($user)
            ->delete($post->path())
            ->assertRedirect('/posts');
        
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /**
     * Act as guest and try to update or delete post
     *
     * @param string $method
     * @return void
     */
    protected function guestUpdateOrDeletePost(string $method)
    {
        $post = PostFactory::create('raw');

        $this->get('/posts/edit')->assertRedirect('login');

        $this->{$method}('/posts/' . $post['slug'], $post)->assertRedirect('login');

        $this->assertDatabaseMissing('posts', $post);
    }

    /**
     * create user and give him permission to delete other users posts
     *
     * @param string $method
     * @return array [\User, \Post]
     */
    protected function userUpdateOrDeletePost(string $method) : array
    {
        [$admin, $user] = UserFactory::createWithAdmin();

        // give user permission to update post
        $admin->givePermTo($user, User::DELETE_POSTS);

        // create post with another user
        $post = PostFactory::ownedBy(UserFactory::create())->create();

        return [$user, $post];
    }
}