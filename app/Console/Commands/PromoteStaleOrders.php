<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Warehouse\Order;
use Illuminate\Console\Command;

/* This class is used to a status of order submitted by a Requestor to be pending_warehouse_approval
   in case the Supervisor does not acknowledge the order
*/
class PromoteStaleOrders extends Command
{
    protected $signature = 'orders:promote-stale';
    protected $description = 'Promote stale orders to warehouse approval after 3 days';

    public function handle()
    {
        $cutoff = Carbon::now()->subDays(3);

        $orders = Order::where('status', 'pending_supervisor_approval')
            ->where('created_at', '<=', $cutoff)
            ->get();

        foreach ($orders as $order) {
            $order->status = 'pending_warehouse_approval';
            $order->note = trim(($order->note ?? '') . "\nAutomatically promoted after 3 days.");
            $order->save();
        }

        $this->info("Promoted {$orders->count()} stale orders.");
    }
}
