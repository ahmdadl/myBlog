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

    /**
     * set http referer for response redirect back
     *
     * @param string $url
     * @return array
     */
    protected function setReferer(string $url) : array
    {
        return ['HTTP_REFERER' => $url];
    }
}
