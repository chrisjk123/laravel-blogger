# Add blog database tables to a Laravel app

[![GitHub version](https://badge.fury.io/gh/chrisjk123%2Flaravel-blogger.svg)](https://packagist.org/packages/chrisjk123/laravel-blogger)
[![build status](https://img.shields.io/travis/chrisjk123/laravel-blogger/master.svg?style=flat-square)](https://travis-ci.org/chrisjk123/laravel-blogger)
[![code quality](https://img.shields.io/scrutinizer/g/chrisjk123/laravel-blogger.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrisjk123/laravel-blogger)
[![downloads](https://img.shields.io/packagist/dt/chrisjk123/laravel-blogger.svg?style=flat-square)](https://packagist.org/packages/chrisjk123/laravel-blogger)
[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

## Table of Contents

* [Introduction](#introduction)
* [Requirements](#requirements)
* [Installation](#installation)
* [Testing](#testing)
* [Usage](#usage)
* [Changelog](#changelog)
* [Security](#security)
* [Credits](#credits)
* [License](#license)

## Introduction

This package is a blogging database with maxed out models, migrations and seeders to help get you setup. After the package is installed the only thing you have to do is add the `HasPosts` trait to an Eloquent model to associate the users.

Here are some code examples:

```php
// Alias namespace path:
// Chriscreates\Blog\Post
// Chriscreates\Blog\Category
// Chriscreates\Blog\Tag
// Chriscreates\Blog\Comment

// Search by the short whereCategories method OR use whereCategory() and specify the field
$results = Post::whereCategories($categories = null)->get();
$results = Post::whereCategory($field, $operator, $value)->get();

// Search by Category ID OR IDs
$results = Post::whereCategories(1)->get();
$results = Post::whereCategory('id', 1)->get();
----------
$results = Post::whereCategories([3, 6, 7])->get();
$results = Post::whereCategory('id', [3, 6, 7])->get();

// Search by Category name OR names
$results = Post::whereCategories('Izabella Bins II')->get();
$results = Post::whereCategory('name', 'Izabella Bins II')->get();
----------
$results = Post::whereCategories(['Izabella Bins II', 'Osborne Fay'])->get();
$results = Post::whereCategory('name', ['Izabella Bins II', 'Osborne Fay'])->get();

// Search by Category model or a Category Collection
$category = Category::where('id', 7)->first();
$results = Post::whereCategories($category)->get();
----------
$categories = Category::whereIn('id', [3, 6, 7])->get();
$results = Post::whereCategories($categories)->get();

// Search by related Post (tags or category)
$post = Post::find(8);
$results = Post::relatedByPostTags($post)->get();
----------
$results = Post::relatedByPostCategory($post)->get();

// Search by published Posts only
Post::published()->get();
----------
Post::publishedLastMonth()->get();
----------
Post::publishedLastWeek()->get();

// Search by unpublished Posts only
Post::notPublished()->get();

// Search by scheduled Posts only
Post::scheduled()->get();

// Search by drafted Posts only
Post::draft()->get();

// Order by latest published
Post::orderByLatest()->get();
```

## Requirements

This package requires Laravel 5.8 or higher, PHP 7.2 or higher and a database that supports json fields and MySQL compatible functions.

## Installation

> Note: Laravel Blogger requires you to have user authentication in place prior to installation.
For Laravel 5.* based projects run the `make:auth` Artisan command.
For Laravel 6.* based projects please see the official guide to get started.

You can install the package via composer:

```bash
composer require chrisjk123/laravel-blogger
```

Publish the primary configuration file using the `blog:install` Artisan command:

```bash
php artisan blog:install
```

This is the contents of the published config file, if your `User` class is
within a different directory or has a different primary key it can be changed here.

```php
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
```

## Testing

Run the tests with:

```bash
composer test
```

## Usage

All you have to do is add the `HasPosts` to your User model to get started.

``` php
namespace App;

use Chriscreates\Blog\Traits\User\HasPosts;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasPosts;

    // ...
}

// Retrieve the posts created by the user(s)
$user->posts;

// Retrieve the comments created by the guest/user(s)
$user->comments;
```

Furthermore, in the configuration file, the default is set to true for
allowing both user and public commenting on posts is set here.

```php
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
```

You can get setup quickly by using the `blog:setup` Artisan command.
This publishes the routes, controllers and views. Optionally you can seed the
database with `factory()` data by specifying the data `--data` option.

```bash
php artisan blog:setup --data
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email christopherjk123@gmail.com instead of using the issue tracker.

## Credits

- [Christopher Kelker](https://github.com/chrisjk123)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
