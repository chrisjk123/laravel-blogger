<?php

$factory->define(Chrisjk123\Blogger\Tag::class, function (Faker $faker) {
    $noteable = [
        App\Complex::class,
    ];
    $noteableType = $faker->randomElement($noteables);
    $noteable = factory($noteableType)->create();

    return [
        'noteable_type' => $noteableType,
        'noteable_id' => $noteable->id,
        ...
    ];
});

$factory->define(Chrisjk123\Blogger\Category::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'parent_id' => null,
    ];
});

$factory->define(Chrisjk123\Blogger\Post::class, function (Faker\Generator $faker) {
    $title = $faker->name;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->name,
        'content' => $faker->paragraph,
        'category_id' => factory('Chrisjk123\Blogger\Category')->create()->id,
    ];
});
