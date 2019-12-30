<?php

namespace Chriscreate\Blog;

use Illuminate\Support\ServiceProvider;

class BloggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/factories/' => database_path('factories'),
        ], 'factories');

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds'),
        ], 'seeders');

        $this->publishes([
            __DIR__.'/../config/blogs.php' => config_path('blogs.php'),
        ], 'config');
    }

    public function register()
    {
    }
}
