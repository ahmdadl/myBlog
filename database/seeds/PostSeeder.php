<?php

use App\Category;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 5 posts
        factory(Post::class, 5)->create()->each(function (Post $post) {
            // create 5 categories and retrive it`s ids
            $ctgIds = factory(Category::class, 5)
                ->create()
                ->pluck('id');
            
            // attach these categories to posts
            $post->categories()->attach($ctgIds);

            // create 5 users
            $members = factory(User::class, rand(2, 5))
                ->create()
                ->pluck('id');
            
            $post->members()->attach($members);
        });
    }
}
