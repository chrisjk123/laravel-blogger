# Add blog database tables to a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisjk123/blogger.svg?style=flat-square)](https://packagist.org/packages/chrisjk123/blogger)
[![Build Status](https://img.shields.io/travis/chrisjk123/blogger/master.svg?style=flat-square)](https://travis-ci.org/chrisjk123/blogger)
[![Quality Score](https://img.shields.io/scrutinizer/g/chrisjk123/blogger.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrisjk123/blogger)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisjk123/blogger.svg?style=flat-square)](https://packagist.org/packages/chrisjk123/blogger)


This package offers fully blog database tables as well as preset models with relations, scopes and seeders.

## Requirements

This package requires Laravel 5.8 or higher, PHP 7.2 or higher and a database that supports json fields and MySQL compatible functions.

## Installation

You can install the package via composer:

```bash
composer require chrisjk123/blogger
```

You can publish the migrations with:

```bash
php artisan vendor:publish --provider="Chrisjk123\Blogger\BloggerServiceProvider" --tag="migrations"
```

Publish the migrations:

```bash
php artisan migrate
```

You can publish the factories with:

```bash
php artisan vendor:publish --provider="Chrisjk123\Blogger\BloggerServiceProvider" --tag="factories"
```

You can publish the seeder with:

```bash
php artisan vendor:publish --provider="Chrisjk123\Blogger\BloggerServiceProvider" --tag="seeders"
```

## Usage

``` php
// Usage description here
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
