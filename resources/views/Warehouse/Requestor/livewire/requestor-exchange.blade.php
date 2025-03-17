<div class="max-w-6xl mx-auto p-6 bg-gray-100 shadow-md rounded-lg">
    <script>
        function updateLivewireBeforeCheckout() {
            // Trigger blur event on all quantity inputs to force Livewire to update
            document.querySelectorAll('input[name^="cart_exchange"]').forEach(input => input.blur());

            // Delay navigation slightly to allow Livewire updates to complete
            setTimeout(() => {
                window.location.href = "{{ route('warehouse.requestor.exchange-checkout') }}";
            }, 300);
        }
    </script>

    <!-- Shopping Cart -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Shopping Cart</h2>

        @if(count($cart) > 0)
            <ul class="border p-4 rounded-md bg-gray-50">
                @foreach ($cart as $item)
                <li class="flex justify-between items-center p-2 border-b last:border-b-0">
                    <span class="font-medium text-gray-700">{{ $item['name'] }}</span>
                    <div class="flex items-center gap-2">
                        <input
                            type="number"
                            min="1"
                            wire:model.live="quantities.{{ $item['id'] }}"
                            class="w-16 p-1 border border-gray-300 rounded"
                        >
                        <button
                            wire:click="removeFromCart({{ $item['id'] }})"
                            class="text-red-500 hover:text-red-700 transition"
                        >
                            ✖
                        </button>
                    </div>
                </li>
            @endforeach
            </ul>

            <!-- Checkout Button -->
            <div class="mt-6 flex justify-center">
                <a href="javascript:void(0)"
                   onclick="updateLivewireBeforeCheckout()"
                   class="bg-green-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-600 transition">
                    Proceed to Checkout
                </a>
            </div>

        @else
            <p class="text-gray-500">Your cart is empty.</p>
        @endif
    </div>

    <!-- Items Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden transform transition">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default-image.jpg') }}"
                     alt="{{ $item->name }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->category->category ?? 'No Category' }}</p>
                    @if(!empty($item->description))
                        <p class="text-sm text-gray-700 mt-2">
                            Description: {{ Str::words($item->description, 5, '...') }}
                        </p>
                    @endif
                    <input type="number" min="1"
                        wire:model.live="quantities.{{ $item->id }}"
                        wire:key="quantity-{{ $item->id }}"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md"
                        placeholder="Enter quantity">

                        <button wire:click="addToCart({{ $item->id }})"
                            class="mt-3 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 text-lg">
                No items found.
            </div>
        @endforelse
        </div>
</div>
