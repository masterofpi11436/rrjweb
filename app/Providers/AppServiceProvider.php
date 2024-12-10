<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use App\Http\Middleware\Auth\VFM;
use App\Http\Middleware\Auth\Admin;
use App\Http\Middleware\Auth\Phone;
use App\Http\Middleware\ClearCache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router)
    {
        // Register the login middleware
        $router->aliasMiddleware('admin', Admin::class);
        $router->aliasMiddleware('phone', Phone::class);
        $router->aliasMiddleware('vfm', VFM::class);
        $router->aliasMiddleware('cache', ClearCache::class);
    }
}
