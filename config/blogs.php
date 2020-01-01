<?php

return [
    /*
     * User: the default path to the User model in Laravel and primary key
     */
    'user' => [
        'user_class' => \App\User::class,
        'user_key_name' => 'id',
    ],

    /*
     * Post: allow commenting on posts / allow guest commenting on posts
     */
    'posts' => [
        'allow_comments' => true,
        'allow_guest_comments' => true,
    ],
];
