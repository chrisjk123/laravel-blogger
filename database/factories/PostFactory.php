<?php

use Chriscreates\Blog\Category;
use Chriscreates\Blog\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'category_id' => factory(Category::class)->create()->id,
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->name,
        'content' => $faker->paragraph,
        'status' => 'published',
        'published_at' => now(),
        'allow_comments' => true,
        'allow_guest_comments' => true,
    ];
});
