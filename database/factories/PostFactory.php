<?php

use Chrisjk123\Blogger\Category;
use Chrisjk123\Blogger\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'category_id' => factory(Category::class)->create()->id,
        'name' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->name,
        'content' => $faker->paragraph,
        'status' => 'published',
        'published_at' => now(),
    ];
});
