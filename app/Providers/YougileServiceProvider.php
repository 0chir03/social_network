<?php

namespace App\Providers;

use App\Service\YougileService;
use Illuminate\Support\ServiceProvider;

class YougileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(YougileService::class, function ($app) {
            return new YougileService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
