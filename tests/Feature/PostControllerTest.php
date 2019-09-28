<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testAnyUserCanViewAllPosts()
    {
        $post = PostFactory::create();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->get('/posts')
            ->assertOk()
            ->assertSee($post->title)
            ->assertSee($post->categories->first());
    }

    public function testPostCanBeViewdBySlug()
    {
        $this->canSeePost(PostFactory::ownedBy($this->signIn())->create());
    }

    public function testGuestCannotCreatePost()
    {
        $this->get('/posts/create')->assertRedirect('login');

        $this->post('/posts', [])->assertRedirect('login');
    }

    public function testAuthrizedUserCanCreatePost()
    {
        $post = PostFactory::ownedBy($this->signIn())->create('raw');

        $this->get('/posts/create')
            ->assertStatus(200)
            ->assertViewIs('post.create');

        $this->post('/posts', $post)
            ->assertRedirect('/posts/' . $post['slug']);
        
        $post = Post::latest()->first();

        $this->canSeePost($post);
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

        $post->title = $this->faker->unique()->sentence;
    
        // try to update post
        $res = $this->actingAs($user)
            ->patch(
                $post->path(),
                $post->attributesToArray(),
                ['HTTP_REFERER' => $post->path()]
            );
        
        // update post slug
        $post->slug = Str::slug($post->title);

        // assert it is being redirect to new slug
        $res->assertRedirect($post->path());
        
        $this->assertDatabaseHas(
            'posts',
            $post->only('title', 'slug')
        );

        $this->canSeePost($post);
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

    public function testUserCanSearchForPosts()
    {
        // create 20 posts with random users
        PostFactory::create('create', 20);
    
        $post = Post::all()->nth(5)->last();

        // hit endpoint for search
        $this->get(
            '/posts/q/' . Str::limit(urlencode($post->title), 5, '')
            )->assertOk()
            ->assertSee($post->title);
    }

    public function testUserCanViewPostAndCategories() : void
    {
       $this->signIn();

        $post = PostFactory::create();

        $ctgIds = factory(Category::class, rand(2, 5))
            ->create()
            ->pluck('id');

        $post->categories()->attach($ctgIds);

        $this->canSeePost($post)
            ->assertSee($post->categories->last()->title);
    }

    /**
     * visit post page and assert all post debendcies can be seen
     *
     * @param Post $post
     * @return void
     */
    protected function canSeePost(Post $post) : TestResponse
    {
        return $this->get($post->path())
            ->assertOk()
            ->assertViewIs('post.show')
            ->assertSee($post->title)
            ->assertSee($post->body)
            ->assertSee($post->owner->name)
            ->assertSee($post->updated_at->diffForHumans());
    }

    /**
     * Act as guest and try to update or delete post
     *
     * @param string $method
     * @return void
     */
    protected function guestUpdateOrDeletePost(string $method) : void
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