<?php

use Illuminate\Support\Facades\Route;

// Login Controllers

use App\Http\Controllers\Policy\PolicyController;
use App\Http\Controllers\Login\ICSLoginController;
use App\Http\Controllers\Login\VFMLoginController;
use App\Http\Controllers\Login\BaseLoginController;
use App\Http\Controllers\Login\AdminLoginController;
use App\Http\Controllers\Login\PhoneLoginController;
use App\Http\Controllers\Login\VFM30LoginController;
use App\Http\Controllers\Login\PolicyLoginController;
use App\Http\Controllers\Login\VFMTechLoginController;
use App\Http\Controllers\Login\WarehouseLoginController;

// Class Controllers
use App\Http\Controllers\ICS\ICSController;
use App\Http\Controllers\VFM\VFMController;
use App\Http\Controllers\VFM30\VFM30Controller;
use App\Http\Controllers\VFM\VFMTechController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Administrator\AdministratorController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\WarehouseSupervisorController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\ItemController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\CategoryController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\SectionController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\UserController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\ReportsHistoryController;
use App\Http\Controllers\Warehouse\WarehouseSupervisor\OrderController;
use App\Http\Controllers\Warehouse\Requestor\RequestorController;
use App\Http\Controllers\Warehouse\Supervisor\SupervisorController;
use App\Http\Controllers\Warehouse\Property\PropertyController;

// Shorthand login Classes
$baseLoginClass = BaseLoginController::class;
$adminLoginClass = AdminLoginController::class;
$phoneLoginClass = PhoneLoginController::class;
$vfmLoginClass = VFMLoginController::class;
$vfm30LoginClass = VFM30LoginController::class;
$vfmTechLoginClass = VFMTechLoginController::class;
$icsLoginClass = ICSLoginController::class;
$policyLoginClass = PolicyLoginController::class;
$warehouseLoginClass = WarehouseLoginController::class;

// Shorthand Controller Classes
$adminClass = AdministratorController::class;
$phoneClass = PhoneDirectoryController::class;
$vfmClass = VFMController::class;
$vfm30Class = VFM30Controller::class;
$vfmTechClass = VFMTechController::class;
$icsClass = ICSController::class;
$policyClass = PolicyController::class;
$warehouseSupervisorClass = WarehouseSupervisorController::class;
$itemClass = ItemController::class;
$categoryClass = CategoryController::class;
$sectionClass = SectionController::class;
$userClass = UserController::class;
$orderClass = OrderController::class;
$reportsHistoryClass = ReportsHistoryController::class;
$requestorClass = RequestorController::class;
$supervisorClass = SupervisorController::class;
$propertyClass = PropertyController::class;

// Forgot password link for all applications
Route::get('forgot', [$baseLoginClass, 'showForgotPasswordForm'])->name('login.forgot');
Route::post('forgot', [$baseLoginClass, 'forgotPassword'])->name('login.forgot.form');

Route::get('/password/reset/{token}', [$baseLoginClass, 'showResetForm'])->name('login.reset');
Route::post('/password/reset', [$baseLoginClass, 'reset'])->name('login.update');
Route::view('/login/success', 'Login.Resets.success')->name('login.success');

// Default Redirect Route for testing
Route::get('/', function () {
    return redirect()->route('warehouse.login');
});

// Public Routes
Route::get('/phone-directory', [$phoneClass, 'phoneDirectory']);
Route::get('/policy-search', [$policyClass, 'policySearch']);

// Admin Routes
Route::prefix('admin')->group(function () use ($adminClass, $adminLoginClass) {

    // Routes without middleware
    Route::get('/login', [$adminLoginClass, 'adminLoginForm'])->name('admin.login');
    Route::post('/login', [$adminLoginClass, 'login']);
    Route::get('/forgot', [$adminLoginClass, 'adminForgotPasswordForm'])->name('admin.forgot.form');
    Route::post('/forgot', [$adminLoginClass, 'forgotPassword'])->name('admin.forgot.form.submit');
    Route::post('/logout', [$adminLoginClass, 'logout'])->name('admin.logout');

    // Routes with 'admin' middleware
    Route::middleware('admin')->group(function () use ($adminClass) {
        Route::get('/dashboard', [$adminClass, 'dashboard'])->name('admin.dashboard')->middleware('cache');
        Route::get('/index', [$adminClass, 'index'])->name('admin.index');
        Route::get('/create', [$adminClass, 'create'])->name('admin.create');
        Route::get('/{id}/edit', [$adminClass, 'edit'])->name('admin.edit');
        Route::delete('/{id}', [$adminClass, 'destroy'])->name('admin.destroy');
    });
});

// Phone Application
Route::prefix('phone')->group(function () use ($phoneClass, $phoneLoginClass){

    // Routes without middleware
    Route::get('/login', [$phoneLoginClass, 'phoneLoginForm'])->name('phone.login');
    Route::post('/login', [$phoneLoginClass, 'login']);
    Route::get('/forgot', [$phoneLoginClass, 'phoneForgotPasswordForm'])->name('phone.forgot.form');
    Route::post('/forgot', [$phoneLoginClass, 'forgotPassword'])->name('phone.forgot.form.submit');
    Route::post('/logout', [$phoneLoginClass, 'logout'])->name('phone.logout');

    // Routes with 'phone' middleware
    Route::middleware('phone')->group(function () use ($phoneClass) {
        Route::get('/dashboard', [$phoneClass, 'dashboard'])->name('phone.dashboard');
        Route::get('/create', [$phoneClass, 'create'])->name('phone.create');
        Route::get('/{id}/edit', [$phoneClass, 'edit'])->name('phone.edit');
        Route::delete('/{id}', [$phoneClass, 'destroy'])->name('phone.destroy');
    });
});

// Vehicle Fleet Maintenance Application (Admins)
Route::prefix('vfm')->group(function () use ($vfmClass, $vfmLoginClass){

    // Routes without middleware
    Route::get('/login', [$vfmLoginClass, 'vfmLoginForm'])->name('vfm.login');
    Route::post('/login', [$vfmLoginClass, 'login']);
    Route::get('/forgot', [$vfmLoginClass, 'vfmForgotPasswordForm'])->name('vfm.forgot.form');
    Route::post('/forgot', [$vfmLoginClass, 'forgotPassword'])->name('vfm.forgot.form.submit');
    Route::post('/logout', [$vfmLoginClass, 'logout'])->name('vfm.logout');

    // Routes with 'vfm' middleware (Admin side)
    Route::middleware('vfm')->group(function () use ($vfmClass) {
        Route::get('/dashboard', [$vfmClass, 'dashboard'])->name('vfm.dashboard');
        Route::get('/create', [$vfmClass, 'create'])->name('vfm.create');
        Route::get('/{id}/edit', [$vfmClass, 'edit'])->name('vfm.edit');
        Route::delete('/{id}', [$vfmClass, 'destroy'])->name('vfm.destroy');
    });
});

Route::prefix('vfm30')->group(function () use ($vfm30Class, $vfm30LoginClass){

    // Routes without middleware
    Route::get('/login', [$vfm30LoginClass, 'vfmLoginForm'])->name('vfm30.login');
    Route::post('/login', [$vfm30LoginClass, 'login']);
    Route::get('/forgot', [$vfm30LoginClass, 'vfmForgotPasswordForm'])->name('vfm30.forgot.form');
    Route::post('/forgot', [$vfm30LoginClass, 'forgotPassword'])->name('vfm30.forgot.form.submit');
    Route::post('/logout', [$vfm30LoginClass, 'logout'])->name('vfm30.logout');

    // Routes with 'vfm' middleware (Admin side)
    Route::middleware('vfm30')->group(function () use ($vfm30Class) {
        Route::get('/dashboard', [$vfm30Class, 'dashboard'])->name('vfm30.dashboard');
        Route::get('/create', [$vfm30Class, 'create'])->name('vfm30.create');
        Route::get('/{id}/edit', [$vfm30Class, 'edit'])->name('vfm30.edit');
        Route::delete('/{id}', [$vfm30Class, 'destroy'])->name('vfm30.destroy');
    });
});

// Vehicle Fleet Maintenance Application (Technicians)
Route::prefix('vfm-tech')->group(function () use ($vfmTechClass, $vfmTechLoginClass){

    // Routes without middleware
    Route::get('/login', [$vfmTechLoginClass, 'VFMTechLoginForm'])->name('vfm-tech.login');
    Route::post('/login', [$vfmTechLoginClass, 'login']);
    Route::get('/forgot', [$vfmTechLoginClass, 'vfmTechForgotPasswordForm'])->name('vfm-tech.forgot.form');
    Route::post('/forgot', [$vfmTechLoginClass, 'forgotPassword'])->name('vfm-tech.forgot.form.submit');
    Route::post('/logout', [$vfmTechLoginClass, 'logout'])->name('vfm-tech.logout');

    // Routes with 'vfm' middleware (Admin side)
    Route::middleware('vfm-tech')->group(function () use ($vfmTechClass) {
        Route::get('/dashboard', [$vfmTechClass, 'dashboard'])->name('vfm-tech.dashboard');
        Route::get('/create', [$vfmTechClass, 'create'])->name('vfm-tech.create');
    });
});

// ICS Application
Route::prefix('ics')->group(function () use ($icsClass, $icsLoginClass){

    // Routes without middleware
    Route::get('/login', [$icsLoginClass, 'icsLoginForm'])->name('ics.login');
    Route::post('/login', [$icsLoginClass, 'login']);
    Route::get('/forgot', [$icsLoginClass, 'icsForgotPasswordForm'])->name('ics.forgot.form');
    Route::post('/forgot', [$icsLoginClass, 'forgotPassword'])->name('ics.forgot.form.submit');
    Route::post('/logout', [$icsLoginClass, 'logout'])->name('ics.logout');

    // Routes with 'ics' middleware
    Route::middleware('ics')->group(function () use ($icsClass) {
        Route::get('/dashboard', [$icsClass, 'dashboard'])->name('ics.dashboard');
        Route::get('/create', [$icsClass, 'create'])->name('ics.create');
        Route::get('/{id}/edit', [$icsClass, 'edit'])->name('ics.edit');
        Route::delete('/{id}', [$icsClass, 'destroy'])->name('ics.destroy');
    });
});

// Policy Application
Route::prefix('policy')->group(function () use ($policyClass, $policyLoginClass){

    // Routes without middleware
    Route::get('/login', [$policyLoginClass, 'policyLoginForm'])->name('policy.login');
    Route::post('/login', [$policyLoginClass, 'login']);
    Route::get('/forgot', [$policyLoginClass, 'policyForgotPasswordForm'])->name('policy.forgot.form');
    Route::post('/forgot', [$policyLoginClass, 'forgotPassword'])->name('policy.forgot.form.submit');
    Route::post('/logout', [$policyLoginClass, 'logout'])->name('policy.logout');

    // Routes with 'policy' middleware
    Route::middleware('policy')->group(function () use ($policyClass) {
        Route::get('/dashboard', [$policyClass, 'dashboard'])->name('policy.dashboard');
        Route::get('/upload', [$policyClass, 'create'])->name('policy.upload');
        Route::post('/upload', [$policyClass, 'store'])->name('policy.upload');
        Route::delete('/{id}', [$policyClass, 'destroy'])->name('policy.destroy');
    });
});

// ***---Warehouse Application---*** //
Route::prefix('warehouse')->group(function () use ($warehouseLoginClass, $warehouseSupervisorClass, $supervisorClass, $requestorClass, $propertyClass, $itemClass, $categoryClass, $sectionClass, $userClass, $reportsHistoryClass, $orderClass){
        // Routes without middleware
        Route::get('/login', [$warehouseLoginClass, 'warehouseLoginForm'])->name('warehouse.login');
        Route::post('/login', [$warehouseLoginClass, 'login']);
        Route::get('/forgot', [$warehouseLoginClass, 'warehouseForgotPasswordForm'])->name('warehouse.forgot.form');
        Route::post('/forgot', [$warehouseLoginClass, 'forgotPassword'])->name('warehouse.forgot.form.submit');
        Route::post('/logout', [$warehouseLoginClass, 'logout'])->name('warehouse.logout');

        // Warehouse Supervisor Routes
        Route::prefix('warehouse-supervisor')->middleware('warehouseSupervisor', 'cache')->group(function () use ($warehouseSupervisorClass, $itemClass, $categoryClass, $sectionClass, $userClass, $reportsHistoryClass, $orderClass) {
            Route::get('/dashboard', [$warehouseSupervisorClass, 'dashboard'])->name('warehouse.warehouse-supervisor.dashboard');

            // User Management
            Route::prefix('user')->group(function () use ($userClass) {
                Route::get('/dashboard', [$userClass, 'dashboard'])->name('warehouse.warehouse-supervisor.user.dashboard');
                Route::get('/create', [$userClass, 'create'])->name('warehouse.warehouse-supervisor.user.create');
                Route::get('/{id}/edit', [$userClass, 'edit'])->name('warehouse.warehouse-supervisor.user.edit');
                Route::delete('/{id}', [$userClass, 'destroy'])->name('warehouse.warehouse-supervisor.user.destroy');
            });

            // Item Management
            Route::prefix('item')->group(function () use ($itemClass) {
                Route::get('/dashboard', [$itemClass, 'dashboard'])->name('warehouse.warehouse-supervisor.item.dashboard');
                Route::get('/create', [$itemClass, 'create'])->name('warehouse.warehouse-supervisor.item.create');
                Route::get('/{id}/edit', [$itemClass, 'edit'])->name('warehouse.warehouse-supervisor.item.edit');
                Route::delete('/{id}', [$itemClass, 'destroy'])->name('warehouse.warehouse-supervisor.item.destroy');
            });

            // Item Management
            Route::prefix('category')->group(function () use ($categoryClass) {
                Route::get('/dashboard', [$categoryClass, 'dashboard'])->name('warehouse.warehouse-supervisor.category.dashboard');
                Route::get('/create', [$categoryClass, 'create'])->name('warehouse.warehouse-supervisor.category.create');
                Route::get('/{id}/edit', [$categoryClass, 'edit'])->name('warehouse.warehouse-supervisor.category.edit');
                Route::delete('/{id}', [$categoryClass, 'destroy'])->name('warehouse.warehouse-supervisor.category.destroy');
            });

            // Section Management
            Route::prefix('section')->group(function () use ($sectionClass) {
                Route::get('/dashboard', [$sectionClass, 'dashboard'])->name('warehouse.warehouse-supervisor.section.dashboard');
                Route::get('/create', [$sectionClass, 'create'])->name('warehouse.warehouse-supervisor.section.create');
                Route::get('/{id}/edit', [$sectionClass, 'edit'])->name('warehouse.warehouse-supervisor.section.edit');
                Route::delete('/{id}', [$sectionClass, 'destroy'])->name('warehouse.warehouse-supervisor.section.destroy');
            });

            // Reports Pages
            Route::prefix('reports-history')->group(function () use ($reportsHistoryClass) {
                Route::get('/dashboard', [$reportsHistoryClass, 'dashboard'])->name('warehouse.warehouse-supervisor.reports_history.dashboard');
            });

            // Create an Order
            Route::prefix('create-order')->group(function () use ($orderClass) {
                Route::get('/dashboard', [$orderClass, 'dashboard'])->name('warehouse.warehouse-supervisor.order.dashboard');
                Route::get('/checkout', [$orderClass, 'checkOut'])->name('warehouse.warehouse-supervisor.order.checkout');
                Route::get('/confirm', [$orderClass, 'confirm'])->name('warehouse.warehouse-supervisor.order.confirm');
            });
        });

        // Warehouse Technician

        // Property
        Route::prefix('property')->middleware('property', 'cache')->group(function () use ($propertyClass) {
            Route::get('/dashboard', [$propertyClass, 'dashboard'])->name('warehouse.property.dashboard');
            Route::get('/checkout', [$propertyClass, 'checkOut'])->name('warehouse.property.checkout');
        });

        // Supervisors
        Route::prefix('supervisor')->middleware('supervisor', 'cache')->group(function () use ($supervisorClass) {
            Route::get('/dashboard', [$supervisorClass, 'dashboard'])->name('warehouse.supervisor.dashboard');
            Route::get('/checkout', [$supervisorClass, 'checkOut'])->name('warehouse.supervisor.checkout');
        });

        // Requestors
        Route::prefix('requestor')->middleware('requestor', 'cache')->group(function () use ($requestorClass) {
            Route::get('/dashboard', [$requestorClass, 'dashboard'])->name('warehouse.requestor.dashboard');
            Route::get('/checkout', [$requestorClass, 'checkOut'])->name('warehouse.requestor.checkout');
        });
});
