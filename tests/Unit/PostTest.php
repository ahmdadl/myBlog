<?php

namespace Tests\Unit;

use App\Post;
use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testItHasMiniBody()
    {
        $post = factory(Post::class)->make();

        $this->assertIsString($post->mini_body);

        $this->assertLessThanOrEqual(250, strlen($post->mini_body));
    }

    public function testItHasSlug()
    {
        $post = factory(Post::class)->make();

        $this->assertIsString($post->slug);

        $this->assertEquals(Str::slug($post->title), $post->slug);
    }

    public function testItHasPath()
    {
        $post = factory(Post::class)->make();

        $this->assertIsString($post->path());

        $this->assertEquals('/posts/' . $post->slug, $post->path());
    }

    public function testItHasOwner()
    {
        $user = $this->signIn();

        $post = PostFactory::ownedBy($user)->create();

        $this->assertEquals(
            $post->owner->toArray(),
            $user->toArray()
        );
    }
}
