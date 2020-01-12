<?php

namespace App\Providers;

use Chriscreates\Blog\Observers\PostObserver;
use Chriscreates\Blog\Post;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class BlogServiceProvider extends ServiceProvider
{
    protected $namespace = '\Chriscreates\Blog\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('post', function ($value) {
            return Post::where(function ($query) use ($value) {
                $query->where('id', $value)
                ->orWhere('slug', 'LIKE', "%{$value}%");
            })->first();
        });

        Post::observe(PostObserver::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapBlogRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapBlogRoutes()
    {
        Route::namespace($this->namespace)
             ->group(base_path('routes/blog.php'));
    }
}
