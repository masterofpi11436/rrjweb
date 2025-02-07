<?php

namespace App\Http\Middleware\Auth\Warehouse;

use App\Http\Middleware\Auth\BaseAuth;

class WarehouseSupervisor extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and is an admin
        return $user && $user->warehouse_role === 'Warehouse Supervisor';
    }

    protected function getRedirectRoute(): string
    {
        return 'warehouse.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to Warehouse Store. Please contact the warehouse supervisor.';
    }
}
