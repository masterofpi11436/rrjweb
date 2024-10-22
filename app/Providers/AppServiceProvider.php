<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckAuthorizationAdmin;
use App\Http\Middleware\CheckAuthorizationPhone;
use App\Http\Middleware\CheckAuthorizationTablet;

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
        $router->aliasMiddleware('admin', CheckAuthorizationAdmin::class);
        $router->aliasMiddleware('phone', CheckAuthorizationPhone::class);
        $router->aliasMiddleware('tablet', CheckAuthorizationTablet::class);
    }
}
