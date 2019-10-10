<?php

namespace Tests\Feature;

use App\Comment;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testGuestCannotCreateComment()
    {
        $post = PostFactory::create();

        $this->post(
            $post->path() . '/comments',
            factory(Comment::class)->raw()
        )->assertRedirect('login');
    }

    public function testUserCanCreateComment()
    {
        $post = PostFactory::ownedBy($user = $this->signIn())
            ->create();

        $comment = factory(Comment::class)->make([
            'userId' => $user->id
        ]);

        $this->post(
            $post->path() . '/comments',
            $comment->only('body'),
            $this->setReferer($post->path())
        )->assertRedirect($post->path());

        $this->assertDatabaseHas('comments', $comment->toArray());

        $this->get($post->path())
            ->assertSee($comment->body)
            ->assertSee($comment->owner->name);
    }

    public function testCommentRequiresBody()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->post($post->path() . '/comments', [])
            ->assertSessionHasErrors();
    }
}