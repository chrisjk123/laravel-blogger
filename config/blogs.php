<?php

return [
    /*
     * The default path to the User model in Laravel
     */
    'user_class' => \App\User::class,
    'user_key_name' => 'id',

    /*
     * The default path to the User model in Laravel
     */
    'posts' => [
        'allow_comments' => true,
        'allow_guest_comments' => true,
    ],
];
