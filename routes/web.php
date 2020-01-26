<?php

Route::group(['middleware' => config('blog.middleware')], function () {
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('posts/{post}', 'PostController@show')->name('posts.show');
});
