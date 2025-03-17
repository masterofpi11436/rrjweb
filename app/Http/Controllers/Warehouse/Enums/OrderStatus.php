<?php

namespace App\Http\Controllers\Warehouse\Enums;

enum OrderStatus: string
{
    case PENDING_WAREHOUSE = 'Pending Warehouse Approval';
    case PENDING_SUPERVISOR = 'Pending Supervisor Approval';
    case PENDING_WAREHOUSE_EXCHANGE = 'Pending Warehouse Exchange Approval';
    case DENIED = 'Denied';
    case APPROVED = 'Approved';
    case EXCHANGE_APPROVED = 'Exchange Approved';
}
