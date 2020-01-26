<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User relations
    |--------------------------------------------------------------------------
    |
    | This is the default path to the User model in Laravel and primary key.
    | You are free to change this path to anything you like.
    |
    */

    'user' => [
        'user_class' => \App\User::class,
        'user_key_name' => 'id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Route middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be attached to every route. You can add your own
    | middleware to this list or change any of the existing middleware.
    |
    */

    'middleware' => [
        'web',
        'auth',
    ],

    /*
     |--------------------------------------------------------------------------
     | Post commenting options
     |--------------------------------------------------------------------------
     |
     | The default for commenting on posts is enabled, as well as guest
     | commenting. Feel free to change these conditions to false.
     |
     */

    'posts' => [
        'allow_comments' => true,
        'allow_guest_comments' => true,
    ],

    /*
     |--------------------------------------------------------------------------
     | Blog table prefix
     |--------------------------------------------------------------------------
     |
     | This is the prefix of the tables that will be created by the migrations
     | and used by the models shipped with this package.
     |
     */

    'table_prefix' => 'blog',
];
