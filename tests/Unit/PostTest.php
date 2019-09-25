<?php

namespace Tests\Unit;

use App\Post;
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
}
