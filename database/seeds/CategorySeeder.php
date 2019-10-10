<?php

use App\Category;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create()->each(function ($c) {
            $posts = factory(Post::class, rand(5, 15))->raw();
            $c->posts()->createMany($posts);

            // create 5 users
            $members = factory(User::class, rand(2, 5))
                ->create()
                ->pluck('id');

            Post::all()->each(function ($post) use ($members) {
                $post->members()->attach($members);
            });
        });
    }
}
