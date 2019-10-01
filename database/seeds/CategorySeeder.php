<?php

use App\Category;
use App\Post;
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
        });
    }
}
