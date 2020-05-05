<?php

Route::group(['middleware' => config('blog.middleware')], function () {
    Route::resource('posts', 'PostController')->except([
        'show',
    ]);

    Route::resource('tags', 'TagController');

    Route::resource('categories', 'CategoryController');
});
