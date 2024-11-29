<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn($asset)=>$this->asset("resources/images/$asset"));
    }
}
