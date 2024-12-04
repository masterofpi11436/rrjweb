<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\Auth\Admin;
use App\Http\Middleware\Auth\OPRList;
use App\Http\Middleware\Auth\Phone;
use App\Http\Middleware\Auth\Tablet;
use App\Http\Middleware\ClearCache;

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
        $router->aliasMiddleware('tablet', Tablet::class);
        $router->aliasMiddleware('oprList', OPRList::class);
        $router->aliasMiddleware('cache', ClearCache::class);
    }
}
