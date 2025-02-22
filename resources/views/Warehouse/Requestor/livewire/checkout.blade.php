<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Back Button -->
    <button onclick="updateLivewireBeforeBack()"
        class="mt-4 bg-yellow-500 text-white px-6 py-3 text-lg font-semibold rounded-md hover:bg-yellow-600 transition shadow-md">
        Back
    </button>

    <script>
        function updateLivewireBeforeBack() {
            // Trigger blur event on all quantity inputs to force Livewire to update
            document.querySelectorAll('input[name^="cart"]').forEach(input => input.blur());

            // Delay navigation slightly to allow Livewire updates to complete
            setTimeout(() => {
                window.location.href = "{{ route('warehouse.requestor.dashboard') }}";
            }, 300);
        }
    </script>

    <h2 class="mt-4 text-xl font-bold mb-4 text-gray-800">Checkout</h2>

    @if(count($cart) > 0)
        <!-- Section Dropdown -->
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Select Section:</label>
            <select wire:model="selectedSection"
                class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                <option value="">-- Select Section --</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->section }}</option>
                @endforeach
            </select>
        </div>

        <!-- Supervisor Dropdown -->
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Select Supervisor:</label>
            <select wire:model="selectedSupervisor"
                class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                <option value="">-- Select Supervisor --</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->id }}">{{ $supervisor->last_name }} {{ $supervisor->first_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Cart Summary -->
        <ul class="border p-4 rounded-md bg-gray-50">
            @foreach ($cart as $item)
                <li class="flex justify-between items-center p-2 border-b last:border-b-0">
                    <!-- Item Name (Aligned Left) -->
                    <span class="font-medium text-gray-700 flex-1">{{ $item['name'] }}</span>

                    <!-- Quantity Controls (Aligned Right) -->
                    <div class="flex items-center space-x-2">
                        <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                            class="px-3 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">-</button>

                        <input type="text" wire:model.live="cart.{{ $item['id'] }}.quantity"
                            wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)"
                            class="w-12 text-center border rounded bg-white shadow-sm">

                        <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                            class="px-3 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">+</button>
                    </div>

                    <!-- Remove Button -->
                    <button wire:click="removeFromCart({{ $item['id'] }})"
                        class="ml-3 text-red-500 hover:text-red-700 transition">
                        ✖
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Clear Cart Button -->
        <button wire:click="clearCart"
            class="mt-4 w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition">
            Clear Cart
        </button>

        <!-- Confirm Order Button -->
        <button onclick="updateLivewireBeforeNavigation()"
            class="mt-4 w-full bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition">
            Confirm Order
        </button>

        <script>
            function updateLivewireBeforeNavigation() {
                // Trigger blur event on all quantity inputs to force Livewire to update
                document.querySelectorAll('input[name^="cart"]').forEach(input => input.blur());

                // Delay navigation slightly to allow Livewire updates to complete
                setTimeout(() => {
                    window.location.href = "{{ route('warehouse.requestor.confirm') }}";
                }, 500);
            }
        </script>

    @else
        <p class="text-gray-500">Your cart is empty.</p>
    @endif
</div>
