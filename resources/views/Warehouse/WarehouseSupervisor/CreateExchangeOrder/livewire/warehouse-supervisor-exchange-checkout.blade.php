<div class="max-w-4xl mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">

    <!-- Back Button -->
    <a href="{{ route('warehouse.warehouse-supervisor.create-exchange-order.dashboard') }}"
       class="mt-4 inline-block bg-yellow-600 text-white border border-yellow-500 px-6 py-3 text-lg font-semibold rounded-md hover:bg-yellow-700">
        Back
    </a>

    <h2 class="mt-4 text-xl font-bold mb-4">Checkout</h2>

    @if(count($cart) > 0)
        <form wire:submit.prevent="submitForm">

            <!-- Section Dropdown -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-200">Select Section:</label>
                <select wire:model="selectedSection" required
                        class="w-full p-3 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="" disabled>-- Select Section --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section }}</option>
                    @endforeach
                </select>
                @error('selectedSection')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Supervisor Dropdown -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-200">Select Supervisor:</label>
                <select wire:model="selectedSupervisor" required
                        class="w-full p-3 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="" disabled>-- Select Supervisor --</option>
                    @foreach($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->last_name }} {{ $supervisor->first_name }}</option>
                    @endforeach
                </select>
                @error('selectedSupervisor')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cart Summary -->
            <ul class="border border-gray-600 p-4 rounded-md bg-gray-800">
                @foreach ($cart as $item)
                    <li class="flex justify-between items-center p-2 border-b border-gray-700 last:border-b-0">
                        <span class="font-medium flex-1">{{ $item['name'] }}</span>

                        <!-- Quantity Controls -->
                        <div class="flex items-center space-x-2">
                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                    type="button"
                                    class="px-3 py-1 bg-gray-700 text-white border border-gray-600 rounded hover:bg-gray-600">
                                -
                            </button>

                            <input type="text"
                                   wire:model.live="cart.{{ $item['id'] }}.quantity"
                                   wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)"
                                   class="w-12 text-center bg-gray-900 text-white border border-gray-600 rounded">

                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                    type="button"
                                    class="px-3 py-1 bg-gray-700 text-white border border-gray-600 rounded hover:bg-gray-600">
                                +
                            </button>
                        </div>

                        <!-- Remove Button -->
                        <button wire:click="removeFromCart({{ $item['id'] }})"
                                type="button"
                                class="ml-3 text-red-400 border border-red-500 px-2 py-1 rounded hover:bg-gray-800 hover:border-red-600">
                            ✖
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Clear Cart -->
            <button wire:click="clearCart"
                    type="button"
                    class="mt-4 w-full bg-red-700 text-white border border-red-600 py-2 rounded-md hover:bg-red-800 hover:border-red-700">
                Clear Cart
            </button>

            <!-- Confirm Order -->
            <button type="submit"
                    class="mt-4 w-full bg-green-700 text-white border border-green-600 py-2 px-6 rounded-md hover:bg-green-800 hover:border-green-700">
                Confirm Order
            </button>
        </form>
    @else
        <p class="text-gray-400">Your cart is empty.</p>
    @endif
</div>
