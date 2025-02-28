<div>
    @if($approvedOrders->count() > 0)
        <ul class="border p-4 rounded-md bg-gray-50">
            @foreach ($approvedOrders as $order)
                <li class="p-3 border-b last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold text-gray-700">Order #{{ $order->id }}</span>
                            <p class="text-sm text-gray-500">Section: {{ $order->section_name }}</p>
                            <p class="text-sm text-gray-500">Supervisor: {{ $order->supervisor_name }}</p>
                            <p class="text-sm text-gray-500">Status: <span class="font-semibold text-yellow-600">{{ $order->status }}</span></p>
                            <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('M d, Y') }}</p>
                        </div>

                        <div class="flex space-x-2">
                            <!-- Toggle Order Details Button -->
                            <button wire:click="toggleOrderDetails({{ $order->id }})"
                                    class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                {{ $expandedOrderId === $order->id ? 'Hide Details' : 'View Details' }}
                            </button>
                        </div>
                    </div>

                    <!-- Ordered Items (Show when expanded) -->
                    @if($expandedOrderId === $order->id)
                        <div class="mt-3 p-3 bg-white border rounded-md">
                            <h3 class="font-semibold text-gray-700">Order Items:</h3>
                            <ul class="mt-2 space-y-2">
                                @foreach (json_decode($order->items, true) as $item)
                                    <li class="flex justify-between text-gray-600">
                                        <span>{{ $item['name'] }}</span>
                                        <span class="font-bold">x{{ $item['quantity'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">No orders found.</p>
    @endif
</div>
