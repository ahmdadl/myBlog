<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        // 'userId' => UserFactory::create(),
        // 'postId' => PostFactory::create(),
        'body' => $faker->text
    ];
});
