<?php

namespace App\Providers;

use App\Contracts\Repositories\HashRepositoryListener;
use App\Repositories\HashRepository;
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
        $this->app->bind(HashRepositoryListener::class, HashRepository::class);
    }
}
