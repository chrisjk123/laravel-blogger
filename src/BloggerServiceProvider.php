<?php

namespace Chriscreates\Blogger;

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
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'blogger');

        // Register the main class to use with the facade
        $this->app->singleton('blogger', function () {
            return new Blogger;
        });
    }
}
