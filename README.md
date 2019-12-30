# Add blog database tables to a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisjk123/laravel-blogger.svg?style=flat-square)](https://packagist.org/packages/chrisjk123/laravel-blogger)
[![Build Status](https://img.shields.io/travis/chrisjk123/laravel-blogger/master.svg?style=flat-square)](https://travis-ci.org/chrisjk123/laravel-blogger)
[![Quality Score](https://img.shields.io/scrutinizer/g/chrisjk123/laravel-blogger.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrisjk123/laravel-blogger)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisjk123/laravel-blogger.svg?style=flat-square)](https://packagist.org/packages/chrisjk123/laravel-blogger)


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

You can install the package via composer:

```bash
composer require chrisjk123/laravel-blogger
```

You can publish the migrations with:

```bash
php artisan vendor:publish --provider="Chriscreates\Blog\BloggerServiceProvider" --tag="migrations"
php artisan migrate
```

You can optionally publish the config file with:

```bash
php artisan vendor:publish --provider="Chriscreates\Blog\BloggerServiceProvider" --tag="config"
```

This is the contents of the published config file, if your `User` class is
within a different directory, you can change it here as well as the User primary key:

```php
return [
    /*
     * The default path to the User model in Laravel
     */
    'user_class' => \App\User::class,
    'user_key_name' => 'id',
];
```

## Local testing

You can publish the factories with:

```bash
php artisan vendor:publish --provider="Chriscreates\Blog\BloggerServiceProvider" --tag="factories"
php artisan vendor:publish --provider="Chriscreates\Blog\BloggerServiceProvider" --tag="seeders"
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

// Retrieve the comments created by the user(s)
$user->comments;
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
