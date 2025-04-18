<?php

return [
    // Database-friendly status values
    'PENDING_SUPERVISOR' => 'pending_supervisor_approval',
    'PENDING_WAREHOUSE' => 'pending_warehouse_approval',
    'PENDING_WAREHOUSE_EXCHANGE' => 'pending_warehouse_exchange_approval',
    'CONSOLIDATED' => 'consolidated',
    'EXCHANGE_CONSOLIDATED' => 'exchange_consolidated',
    'APPROVED' => 'approved',
    'EXCHANGE_APPROVED' => 'exchange_approved',
    'DENIED' => 'denied',
    'EXCHANGE_DENIED' => 'exchange_denied',

    // Human-readable labels for UI display
    'labels' => [
        'pending_supervisor_approval' => 'Pending Supervisor Approval',
        'pending_warehouse_approval' => 'Pending Warehouse Approval',
        'pending_warehouse_exchange_approval' => 'Pending Warehouse Exchange Approval',
        'consolidated' => 'Consolidated',
        'exchange_consolidated' => 'Exchange Consolidated',
        'approved' => 'Approved',
        'exchange_approved' => 'Exchange Approved',
        'denied' => 'Denied',
        'exchange_denied' => 'Exchange Denied',
    ],
];
