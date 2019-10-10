<?php

namespace Tests\Unit;

use App\Comment;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasOwner()
    {
        [$post, $comment] = PostFactory::withComments()
            ->ownedBy($user = $this->signIn())
            ->createBoth();

        $this->assertEquals($comment->owner->name, $user->name);
    }

    public function testItBelongsToPost()
    {
        [$post, $comment] = PostFactory::withComments()
            ->ownedBy($this->signIn())
            ->createBoth('make');

        $comment = $post->comment($comment->body);

        $this->assertEquals($comment->post->id, $post->id);
    }

    // public function testItHasActivity()
    // {
    //     // $comment = factory(Comment::class)
    // }
}
