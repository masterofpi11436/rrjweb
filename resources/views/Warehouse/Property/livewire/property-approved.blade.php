<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-600 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if($approvedOrders->count() > 0)
        <ul class="border border-gray-700 p-4 rounded-md bg-gray-800">
            @foreach ($approvedOrders as $order)
                <li class="p-3 border-b border-gray-700 last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold text-gray-200">Order #{{ $order->id }}</span>
                            <p class="text-sm text-gray-400">Section: {{ $order->section_name }}</p>
                            <p class="text-sm text-gray-400">Supervisor: {{ $order->supervisor_name }}</p>
                            <p class="text-sm text-gray-400">
                                Status: <span class="font-semibold text-yellow-400">{{ $order->status }}</span>
                            </p>
                            <p class="text-sm text-gray-400">Date: {{ $order->created_at->format('M d, Y') }}</p>
                        </div>

                        <div class="flex space-x-2">
                            <button wire:click="toggleOrderDetails({{ $order->id }})"
                                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                {{ $expandedOrderId === $order->id ? 'Hide Details' : 'View Details' }}
                            </button>
                        </div>
                    </div>

                    @if($expandedOrderId === $order->id)
                        <div class="mt-3 p-3 bg-gray-700 border border-gray-600 rounded-md">
                            <h3 class="font-semibold text-gray-200">Order Items:</h3>
                            <ul class="mt-2 space-y-2">
                                @foreach (json_decode($order->items, true) as $item)
                                    <li class="flex justify-between text-gray-300">
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
        <p class="text-gray-400">No pending orders found.</p>
    @endif
</div>
