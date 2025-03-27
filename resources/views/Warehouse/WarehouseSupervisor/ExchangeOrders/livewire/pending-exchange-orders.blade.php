<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if($pendingOrders->count() > 0)
        <ul class="border p-4 rounded-md bg-gray-50">
            @foreach ($pendingOrders as $order)
                <li class="p-3 border-b last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold text-gray-700">Order #{{ $order->id }}</span>
                            <p class="text-sm text-gray-500">Section: {{ $order->section_name }}</p>
                            <p class="text-sm text-gray-500">Supervisor: {{ $order->supervisor_name }}</p>
                            <p class="text-sm text-gray-500">Status: <span class="font-semibold text-yellow-600">{{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}</span></p>
                            <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('M d, Y') }}</p>
                        </div>

                        <div class="flex space-x-2">

                            <!-- View Order -->
                            <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.show', ['id' => $order->id]) }}" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                View Order
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">No pending orders found.</p>
    @endif
</div>
