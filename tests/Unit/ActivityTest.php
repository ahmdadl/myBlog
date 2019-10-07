<?php

namespace Tests\Unit;

use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    
    public function testItHasOwner()
    {
        $post = PostFactory::ownedBy(
            $this->signIn($admin = UserFactory::admin())
        )->create();

        $this->assertEquals(
            $admin->name,
            $post->activity->last()->owner->name
        );
    }
}
