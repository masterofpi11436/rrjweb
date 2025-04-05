<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if (count($pendingExchangeOrders) > 0)
        @foreach ($pendingExchangeOrders as $section => $orders)
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-700 mb-2">{{ $section }}</h2>
                <ul class="border p-4 rounded-md bg-gray-50">
                    @if(count($orders) > 1)
                        <button wire:click="consolidateOrders('{{ $section }}')"
                            class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-purple-700 transition duration-300 ease-in-out mb-3">
                            Consolidate Orders
                        </button>
                    @endif
                    @foreach ($orders as $order)
                        <li class="p-3 border-b last:border-b-0">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold text-gray-700">Order #{{ $order['id'] }}</span>
                                    <p class="text-sm text-gray-500">Supervisor: {{ $order['supervisor_name'] }}</p>
                                    <p class="text-sm text-gray-500">Status: <span class="font-semibold text-yellow-600">{{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}</span></p>
                                    <p class="text-sm text-gray-500">Date: {{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y') }}</p>
                                </div>

                                <div class="flex space-x-2">
                                    <!-- View Order -->
                                    <a href="{{ route('warehouse.warehouse-supervisor.pending.show', ['id' => $order['id']]) }}" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                        View Order
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">No pending orders found.</p>
    @endif
</div>
