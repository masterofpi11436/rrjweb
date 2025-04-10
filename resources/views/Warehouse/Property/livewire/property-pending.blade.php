<div class="text-gray-100">
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-600 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if(count($pendingOrders) > 0)
        @foreach ($pendingOrders as $groupKey => $orders)
            @php
                [$sectionName, $status] = explode(' - ', $groupKey);
            @endphp
            <div class="border border-gray-700 p-4 rounded-md bg-gray-800 mb-5">
                <h3 class="text-lg font-bold text-white">Section: {{ $sectionName }}</h3>

                @if(count($orders) > 1)
                    <button wire:click="consolidateOrders('{{ $sectionName }}', '{{ $status }}')"
                            class="px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-lg shadow-md hover:bg-purple-800 mt-2">
                        Consolidate Orders
                    </button>
                @endif

                <ul class="mt-3">
                    @foreach ($orders as $order)
                        <li class="p-3 border-b border-gray-700 last:border-b-0">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold text-gray-200">Order #{{ $order['id'] }}</span>
                                    <p class="text-sm text-gray-400">
                                        Status:
                                        <span class="font-semibold text-yellow-400">
                                            {{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}
                                        </span>
                                    </p>
                                    <p class="text-sm text-gray-400">Date: {{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y') }}</p>
                                </div>

                                <div class="flex space-x-2">
                                    <button wire:click="toggleOrderDetails({{ $order['id'] }})"
                                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                        {{ $expandedOrderId === $order['id'] ? 'Hide Details' : 'View Details' }}
                                    </button>

                                    <a href="{{ route('warehouse.property.edit-order', ['id' => $order['id']]) }}"
                                        class="px-4 py-2 bg-yellow-600 text-white text-sm rounded hover:bg-yellow-700">
                                        Edit Order
                                    </a>

                                    <a href="{{ route('warehouse.property.destroy', $order['id']) }}"
                                        class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-red-700"
                                        onclick="event.preventDefault(); confirmDelete({{ $order['id'] }});">
                                        Cancel Order
                                    </a>

                                    <form id="delete-form-{{ $order['id'] }}" action="{{ route('warehouse.property.destroy', $order['id']) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <div id="custom-confirmation-modal-{{ $order['id'] }}" class="confirmation-modal" style="display: none;">
                                        <div class="modal-content bg-gray-900 text-gray-100 p-4 rounded-md shadow-lg border border-gray-700">
                                            <p>Are you sure you want to delete this order?</p>
                                            <div class="mt-4 flex justify-end gap-2">
                                                <button class="px-4 py-2 bg-red-600 rounded hover:bg-red-700" onclick="deleteRecord({{ $order['id'] }});">Yes, Delete</button>
                                                <button class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600" onclick="hideModal({{ $order['id'] }});">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($expandedOrderId === $order['id'])
                                <div class="mt-3 p-3 bg-gray-700 border border-gray-600 rounded-md">
                                    <h3 class="font-semibold text-white">Order Items:</h3>
                                    <ul class="mt-2 space-y-2">
                                        @foreach (json_decode($order['items'], true) as $item)
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
            </div>
        @endforeach
    @else
        <p class="text-gray-400">No pending orders found.</p>
    @endif
</div>
