<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testAnyUserCanViewAllPosts()
    {
        $this->withoutExceptionHandling();

        $post = factory(\App\Post::class)->create();

        $this->get('/posts')->assertSee($post->title);
    }
}
