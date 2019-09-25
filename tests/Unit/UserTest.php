<?php declare(strict_types = 1);

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testItHasPermission() : void
    {
        $this->assertIsInt(User::ADD_POSTS);
        $this->assertIsInt(User::DELETE_POSTS);
        $this->assertIsInt(User::ADD_CATEGORIES);
        $this->assertIsInt(User::EDIT_CATEGORIES);
        $this->assertIsInt(User::EDIT_USER_ACCESS);

        // create user
        $user = factory(User::class)->create();

        // give him add_categories permission
        $user->perm = User::ADD_CATEGORIES 
            + User::DELETE_POSTS 
            + User::ADD_POSTS;

        // check if user can delete posts
        $this->assertTrue($user->canDo('post'));

        // check if user can add categories
        $this->assertTrue($user->canDo('add_ctg'));

        // check if user cannot edit categories
        $this->assertFalse($user->canDo('edit_ctg'));

        // check if user cannot update user access
        $this->assertFalse($user->canDo('edit_access'));
    }
}
