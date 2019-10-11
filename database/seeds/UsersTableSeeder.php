<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin account
        factory(User::class)->create([
            'name' => 'Ahmed Adel',
            'email' => 'admin@example.tld',
            'perm' => 31
        ]);

        //create super account
        factory(User::class)->create([
            'email' => 'super@example.tld',
            'perm' => 15
        ]);

        // create random users
        factory(User::class, 20)->create([
            'perm' => Arr::random([1, 2, 4, 8, 15])
        ]);
    }
}
