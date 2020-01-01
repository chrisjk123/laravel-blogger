<?php

use Chriscreates\Blog\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'name' => $title,
        'slug' => Str::slug($title),
        'parent_id' => null,
    ];
});
