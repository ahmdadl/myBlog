<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(Post::class, 20)->create();

        $posts->each(function (Post $post) {
            $len = strlen(Str::random(rand(2, 5)));

            for ($x = 0; $x < $len; $x++) {
                $post->addCategory(
                    factory(Category::class)->create()->id
                );
            }
        });
        
    }
}
