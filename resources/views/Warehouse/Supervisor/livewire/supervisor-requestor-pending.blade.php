<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('success') }}</span>
            <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if($pendingRequestorOrders->count() > 0)
        <ul class="border p-4 rounded-md bg-gray-50">
            @foreach ($pendingRequestorOrders as $order)
                <li class="p-3 border-b last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold text-gray-700">Order #{{ $order->id }}</span>
                            <p class="text-sm text-gray-500">Section: {{ $order->section_name }}</p>
                            <p class="text-sm text-gray-500">Requestor: {{ $order->user_name }}</p>
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

                            <!-- Edit Order Button -->
                            <a href="{{ route('warehouse.supervisor.edit-requestor-order', ['id' => $order->id]) }}" class="px-4 py-2 bg-yellow-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                Edit Order
                            </a>

                            <!-- Delete Button -->
                            <a href="{{ route('warehouse.supervisor.destroy', $order->id) }}" class="px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition"
                                onclick="event.preventDefault(); confirmDelete({{ $order->id }});">
                                Cancel Order
                            </a>

                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $order->id }}" action="{{ route('warehouse.supervisor.destroy', $order->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <!-- Delete Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $order->id }}" class="confirmation-modal" style="display: none;">
                                <div class="modal-content">
                                    <p>Are you sure you want to delete this order?</p>
                                    <button class="btn-confirm" onclick="deleteRecord({{ $order->id }});">Yes, Delete</button>
                                    <button class="btn-cancel" onclick="hideModal({{ $order->id }});">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items (Show when expanded) -->
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
        <p class="text-gray-500">No pending orders found.</p>
    @endif
</div>
