<?php declare(strict_types = 1);

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(?User $user = null) : User
    {
        if (is_null($user)) {
            $user = factory(User::class)->create();
        }

        $this->actingAs($user);

        return $user;
    }
}
