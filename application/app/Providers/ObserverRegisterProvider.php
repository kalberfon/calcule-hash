<?php

namespace App\Providers;

use App\Models\Hash;
use App\Observers\HashObserver;
use Illuminate\Support\ServiceProvider;

class ObserverRegisterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Hash::observe(HashObserver::class);
    }
}
