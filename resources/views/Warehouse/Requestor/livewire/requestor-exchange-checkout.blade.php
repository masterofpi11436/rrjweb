<div class="max-w-4xl mx-auto p-6 bg-gray-900 shadow-md rounded-lg text-gray-100">
    <!-- Back Button -->
    <a href="{{ route('warehouse.requestor.exchange') }}"
       class="mt-4 bg-yellow-600 text-white px-6 py-3 text-lg font-semibold rounded-md hover:bg-yellow-700 shadow-md border border-white">
        Back
    </a>

    <h2 class="mt-4 text-xl font-bold mb-4 text-white">Checkout</h2>

    @if(count($cart) > 0)
        <form wire:submit.prevent="submitForm">
            <!-- Section Dropdown -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-200">Select Section:</label>
                <select wire:model="selectedSection" required
                        class="w-full p-3 border border-white rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-800 text-white">
                    <option value="" disabled>-- Select Section --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section }}</option>
                    @endforeach
                </select>
                @error('selectedSection')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cart Summary -->
            <ul class="border border-white p-4 rounded-md bg-gray-800">
                @foreach ($cart as $item)
                    <li class="flex justify-between items-center p-2 border-b border-gray-600 last:border-b-0">
                        <span class="font-medium text-gray-200 flex-1">{{ $item['name'] }}</span>

                        <div class="flex items-center space-x-2">
                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                    type="button"
                                    class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-600">
                                -
                            </button>

                            <input type="text"
                                   wire:model.live="cart.{{ $item['id'] }}.quantity"
                                   wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)"
                                   class="w-12 text-center border border-gray-600 rounded bg-gray-900 text-white shadow-sm">

                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                    type="button"
                                    class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-600">
                                +
                            </button>
                        </div>

                        <button wire:click="removeFromCart({{ $item['id'] }})"
                                type="button"
                                class="ml-3 text-red-400 hover:text-red-600">
                            ✖
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Clear Cart Button -->
            <button wire:click="clearCart"
                    type="button"
                    class="mt-4 w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 border border-white">
                Clear Cart
            </button>

            <!-- Confirm Order Button -->
            <button type="submit"
                    class="mt-4 w-full bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 border border-white">
                Confirm Order
            </button>
        </form>
    @else
        <p class="text-gray-400">Your cart is empty.</p>
    @endif
</div>
