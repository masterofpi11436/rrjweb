<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-700 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if (count($pendingOrders) > 0)
        @foreach ($pendingOrders as $section => $orders)
            <div class="mb-6">
                <h2 class="text-lg font-bold text-white mb-2">{{ $section }}</h2>
                <ul class="border border-gray-700 p-4 rounded-md bg-gray-800">
                    @if(count($orders) > 1)
                        <button wire:click="consolidateOrders('{{ $section }}')"
                            class="px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-lg border border-purple-600 hover:bg-purple-800 mb-3">
                            Consolidate Orders
                        </button>
                    @endif
                    @foreach ($orders as $order)
                        <li class="p-3 border-b border-gray-700 last:border-b-0">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold text-white">Order #{{ $order['id'] }}</span>
                                    <p class="text-sm text-gray-300">Supervisor: {{ $order['supervisor_name'] }}</p>
                                    <p class="text-sm text-gray-300">
                                        Status:
                                        <span class="font-semibold text-yellow-400">
                                            {{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}
                                        </span>
                                    </p>
                                    <p class="text-sm text-gray-300">Date: {{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y') }}</p>
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.pending.show', ['id' => $order['id']]) }}"
                                       class="px-4 py-2 bg-blue-700 text-white text-sm rounded border border-blue-600 hover:bg-blue-800 hover:border-blue-700">
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
        <p class="text-gray-400">No pending orders found.</p>
    @endif
</div>
