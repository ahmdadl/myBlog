<?php declare(strict_types = 1);

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testHeCanBeGivedPermission()
    {
        $user = factory(User::class)->create();

        $user->givePermTo(User::ADD_CATEGORIES);

        $this->assertTrue($user->canDo(User::ADD_CATEGORIES));
        $this->assertFalse($user->canDo(User::EDIT_CATEGORIES));
    }

    public function testHeHasPermission() : void
    {
        // create user
        $user = factory(User::class)->create();

        // give him add_categories permission
        $user->givePermTo(User::ADD_CATEGORIES);

        // check if user can delete posts
        $this->assertTrue($user->canDo(User::ADD_POSTS));

        // check if user can add categories
        $this->assertTrue($user->canDo(User::ADD_CATEGORIES));

        // check if user cannot edit categories
        $this->assertFalse($user->canDo(User::EDIT_CATEGORIES));

        // check if user cannot update user access
        $this->assertFalse($user->canDo(User::EDIT_USER_ACCESS));
    }

    public function testHeHasType() : void
    {
        $user = factory(User::class)->create();

        // give him edit_categories permission
        $user->givePermTo(User::EDIT_CATEGORIES);

        $this->assertEquals('super', $user->type);

        // give him edit user access permission
        $user->givePermTo(User::EDIT_USER_ACCESS);

        $this->assertEquals('admin', $user->type);
    }
}
