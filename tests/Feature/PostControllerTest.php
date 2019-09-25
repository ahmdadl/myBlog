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
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function testPostCanBeViewdBySlug()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->get('/posts/'. $post->slug)
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->body);
    }
}
