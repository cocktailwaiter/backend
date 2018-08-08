<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Fluent(Query Builder)
        \App::bind('App\Repositories\CommentRepositoryInterface', 'App\Repositories\Fluent\CommentRepository');
        \App::bind('App\Repositories\TagCategoryRepositoryInterface', 'App\Repositories\Fluent\TagCategoryRepository');
    }
}

