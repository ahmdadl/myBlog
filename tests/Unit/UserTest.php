<?php declare(strict_types = 1);

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testHeCanBeGivedPermission()
    {
        [$admin, $user] = UserFactory::createWithAdmin();

        $admin->givePermTo($user, User::ADD_CATEGORIES);

        $this->assertTrue($user->canDo(User::ADD_CATEGORIES));
        $this->assertFalse($user->canDo(User::EDIT_CATEGORIES));
    }

    public function testHeHasPermission() : void
    {
        // create admin and user
        [$admin, $user] = UserFactory::createWithAdmin();

        // give him add_categories permission
        $admin->givePermTo($user, User::ADD_CATEGORIES);

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
        [$admin, $user] = UserFactory::createWithAdmin();

        // give him edit_categories permission
        $admin->givePermTo($user, User::EDIT_CATEGORIES);

        $this->assertEquals('super', $user->type);

        // give him edit user access permission
        $admin->givePermTo($user, User::EDIT_USER_ACCESS);

        $this->assertEquals('admin', $user->type);
    }

    public function testOnlyAdminCanEditUserAccess()
    {
        $admin = UserFactory::admin();
        $randomUser = UserFactory::create();

        $this->assertTrue(
            $admin->givePermTo($randomUser, User::EDIT_CATEGORIES)
        );

        $this->assertFalse(
            $randomUser->givePermTo($admin, User::EDIT_USER_ACCESS)
        );
    }

    public function testHeCanCreatePostWithSlug()
    {
        $post = PostFactory::ownedBy($user = $this->signIn())
            ->create('make');
        
        $post = $user->createWithSlug($post->attributesToArray());

        $this->assertEquals(
            $user->posts->last()->toArray(),
            $post->toArray()
        );
    }
}
