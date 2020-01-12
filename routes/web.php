<?php

Route::group(['middleware' => config('blog.middleware')], function () {
    Route::resource('posts', 'PostController');
});

Route::get('posts/{post}', 'PostController@show')->name('posts.show');
