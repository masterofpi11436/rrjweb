<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use App\Http\Middleware\Auth\ICS;
use App\Http\Middleware\Auth\VFM;
use App\Http\Middleware\Auth\Admin;
use App\Http\Middleware\Auth\Phone;
use App\Http\Middleware\ClearCache;
use App\Http\Middleware\Auth\Policy;
use App\Http\Middleware\Auth\VFMTech;
use App\Http\Middleware\Auth\Jurisdiction;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\Auth\Warehouse\WarehouseSupervisor;
use App\Http\Middleware\Auth\Warehouse\WarehouseTechnician;
use App\Http\Middleware\Auth\Warehouse\Property;
use App\Http\Middleware\Auth\Warehouse\Supervisor;
use App\Http\Middleware\Auth\Warehouse\Requestor;
use App\Http\Middleware\ClearCart;

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
        $router->aliasMiddleware('vfm-tech', VFMTech::class);
        $router->aliasMiddleware('ics', ICS::class);
        $router->aliasMiddleware('policy', Policy::class);
        $router->aliasMiddleware('jurisdiction', Jurisdiction::class);
        $router->aliasMiddleware('warehouseSupervisor', WarehouseSupervisor::class);
        $router->aliasMiddleware('warehouseTechnician', WarehouseTechnician::class);
        $router->aliasMiddleware('property', Property::class);
        $router->aliasMiddleware('supervisor', Supervisor::class);
        $router->aliasMiddleware('requestor', Requestor::class);
        $router->aliasMiddleware('cache', ClearCache::class);
        $router->aliasMiddleware('clear-cart', ClearCart::class);
    }
}
