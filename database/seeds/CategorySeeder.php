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
        factory(Category::class, rand(5, 9))->create()->each(function ($c) {
            $posts = Post::limit(rand(25, 250))->pluck('id');
            $c->posts()->attach($posts);
        });
    }
}
