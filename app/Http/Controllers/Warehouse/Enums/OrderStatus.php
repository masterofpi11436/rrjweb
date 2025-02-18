<?php

namespace App\Http\Controllers\Warehouse\Enums;

enum OrderStatus: string
{
    case PENDING_WAREHOUSE = 'Pending Warehouse Approval';
    case PENDING_SUPERVISOR = 'Pending Supervisor Approval';
    case DENIED = 'Denied';
    case COMPLETED = 'Approved';
}
