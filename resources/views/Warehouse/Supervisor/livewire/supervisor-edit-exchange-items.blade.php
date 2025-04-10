<div class="max-w-6xl mx-auto p-6 bg-gray-900 shadow-md rounded-lg text-gray-100">

    <!-- Shopping Cart -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold mb-4 text-white">Shopping Cart</h2>

        @if(count($cart) > 0)
            <ul class="border border-gray-700 p-4 rounded-md bg-gray-700">
                @foreach ($cart as $item)
                <li class="flex justify-between items-center p-2 border-b border-gray-600 last:border-b-0">
                    <span class="font-medium text-gray-200">{{ $item['name'] }}</span>
                    <div class="flex items-center gap-2">
                        <input
                            type="number"
                            min="1"
                            wire:model.live="quantities.{{ $item['id'] }}"
                            wire:key="quantity-{{ $item['id'] }}"
                            class="w-16 p-1 border border-gray-600 rounded bg-gray-900 text-white"
                        >
                        <button wire:click="removeFromCart({{ $item['id'] }})"
                            class="text-red-400 hover:text-red-600">
                            ✖
                        </button>
                    </div>
                </li>
                @endforeach
            </ul>

            <!-- Confirm Edits Button -->
            <div class="mt-6 flex justify-center">
                <button wire:click="updateOrder"
                    class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700">
                    Confirm Edits
                </button>
            </div>

        @else
            <p class="text-gray-400">Your cart is empty.</p>
        @endif
    </div>

    <!-- Items Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-md overflow-hidden">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default-image.jpg') }}"
                     alt="{{ $item->name }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-white">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-400">{{ $item->category->category ?? 'No Category' }}</p>
                    <input type="number" min="1" wire:model.live="quantities.{{ $item->id }}"
                        wire:key="quantity-{{ $item->id }}"
                        class="w-full mt-2 p-2 border border-gray-600 rounded-md bg-gray-900 text-white" placeholder="Enter quantity">
                    <button wire:click="addToCart({{ $item->id }})"
                            class="mt-3 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 text-lg">
                No items found.
            </div>
        @endforelse
    </div>
</div>
