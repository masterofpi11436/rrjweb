<?php

namespace App\Providers;

use App\Http\Middleware\Auth\Admin;
use App\Http\Middleware\Auth\Camera;
use App\Http\Middleware\Auth\Jurisdiction;
use App\Http\Middleware\Auth\Mailroom;
use App\Http\Middleware\Auth\Phone;
use App\Http\Middleware\Auth\Policy;
use App\Http\Middleware\Auth\Tablet;
use App\Http\Middleware\Auth\Training\TrainingAdmin;
use App\Http\Middleware\Auth\VFM;
use App\Http\Middleware\Auth\VFMTech;
use App\Http\Middleware\Auth\Warehouse\Property;
use App\Http\Middleware\Auth\Warehouse\Requestor;
use App\Http\Middleware\Auth\Warehouse\Supervisor;
use App\Http\Middleware\Auth\Warehouse\WarehouseSupervisor;
use App\Http\Middleware\Auth\Warehouse\WarehouseTechnician;
use App\Http\Middleware\ClearCache;
use App\Http\Middleware\ClearCart;
use App\Models\Training\TrainingBookPartModuleChecklist;
use App\Models\Training\TrainingBookPartModuleEvaluation;
use App\Models\Training\TrainingBookPartModuleForm;
use App\Models\Training\TrainingBookPartModuleMedia;
use App\Models\Training\TrainingBookPartModuleParagraph;
use App\Models\Training\TrainingBookPartModuleSOPChecklist;
use App\Models\Training\TrainingBookPartModuleTest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Routing\Router;
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
        $router->aliasMiddleware('vfm-tech', VFMTech::class);
        $router->aliasMiddleware('tablet', Tablet::class);
        $router->aliasMiddleware('mailroom', Mailroom::class);
        $router->aliasMiddleware('policy', Policy::class);
        $router->aliasMiddleware('camera', Camera::class);
        $router->aliasMiddleware('jurisdiction', Jurisdiction::class);
        $router->aliasMiddleware('warehouseSupervisor', WarehouseSupervisor::class);
        $router->aliasMiddleware('warehouseTechnician', WarehouseTechnician::class);
        $router->aliasMiddleware('property', Property::class);
        $router->aliasMiddleware('supervisor', Supervisor::class);
        $router->aliasMiddleware('requestor', Requestor::class);

        $router->aliasMiddleware('trainingAdmin', TrainingAdmin::class);
        $router->aliasMiddleware('cache', ClearCache::class);
        $router->aliasMiddleware('clear-cart', ClearCart::class);

        // Training Application map
        // Relation::enforceMorphMap([
        //     'paragraph' => TrainingBookPartModuleParagraph::class,
        //     'media' => TrainingBookPartModuleMedia::class,
        //     'form' => TrainingBookPartModuleForm::class,
        //     'checklist' => TrainingBookPartModuleChecklist::class,
        //     'sop_checklist' => TrainingBookPartModuleSOPChecklist::class,
        //     'test' => TrainingBookPartModuleTest::class,
        //     'evaluation' => TrainingBookPartModuleEvaluation::class,
        // ]);
    }
}
