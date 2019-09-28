<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->unique()->text(60);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->text(850),
        'img' => Arr::random([1, 2, 3, 4, 5]) . '.png',
        'userId' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
