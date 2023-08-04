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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\LancamentosRepository::class, \App\Repositories\LancamentosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClientesRepository::class, \App\Repositories\ClientesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TiposRepository::class, \App\Repositories\TiposRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdminAreasRepository::class, \App\Repositories\AdminAreasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdminAreasPermitidasRepository::class, \App\Repositories\AdminAreasPermitidasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
