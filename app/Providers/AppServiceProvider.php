<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );

        $this->app->bind(
            'App\Repositories\CommentRepositoryInterface',
            'App\Repositories\Fluent\CommentRepository'
        );
    }

    public function boot()
    {
        \DB::listen(function ($query) {
            \Log::info("[SQL] " . $this->gemerateSqlQuery($query->sql, $query->bindings));
        });
    }

    protected function gemerateSqlQuery(string $query, array $params) {
        foreach($params as $replace) {
            $target_pos = strpos($query, '?');
            $query = preg_replace("/\?/", "", $query, 1);
            $query = mb_substr($query, 0, $target_pos) . $replace . mb_substr($query, $target_pos, strlen($query));
        }

        return $query;
    }
}
