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
        $user = UserFactory::create();

        $comment = factory(Comment::class)->create([
            'postId' => PostFactory::create()->id,
            'userId' => $user->id
        ]);

        $this->assertEquals($comment->owner->name, $user->name);
    }

    public function testItBelongsToPost()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $comment = factory(Comment::class)->make();

        $comment = $post->comment($comment->body);

        $this->assertEquals($comment->post->id, $post->id);
    }
}
