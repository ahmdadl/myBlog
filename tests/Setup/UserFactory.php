<?php declare(strict_types = 1);

namespace Tests\Setup;

use App\User;

class UserFactory
{
    public function create(string $method = 'create') : User
    {
        return factory(User::class)->{$method}();
    }   
    
    public function admin() : User
    {
        return factory(User::class)->create([
            'perm' => User::ADD_POSTS + User::DELETE_POSTS + User::ADD_CATEGORIES + User::EDIT_CATEGORIES + User::EDIT_USER_ACCESS
        ]);
    }

    public function createWithAdmin() : array
    {
        return [
            $this->admin(),
            $this->create()
        ];
    }
}