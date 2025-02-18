<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- Item Name -->
        <div>
            <label for="name" class="block text-gray-700 font-medium">Item</label>
            <input type="text" id="name" wire:model="name" required
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Category Selection Dropdown -->
        <div>
            <label for="category_id" class="block text-gray-700 font-medium">Category</label>
            <select id="category_id" wire:model="category_id"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <!-- Image Upload -->
        <div>
            <label for="image" class="block text-gray-700 font-medium">Image</label>
            <input type="file" id="image" wire:model="image"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Image Preview -->
            @if ($imagePreview)
                <div class="mt-3 flex flex-col items-center">

                    <img src="{{ $imagePreview }}" class="rounded-md shadow-md object-cover w-40 h-40">

                    <!-- Show Remove Button Only If Image Is Not the Default -->
                    @if ($imagePreview !== asset('images/default-image.jpg'))
                        <button type="button" wire:click="removeImage"
                            class="mt-2 px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                            Remove Image
                        </button>
                    @endif

                </div>
            @endif
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="block text-gray-700 font-medium">Quantity</label>
            <input type="number" id="quantity" wire:model="quantity" required min="0"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Low Stock Threshold -->
        <div>
            <label for="low_stock_threshold" class="block text-gray-700 font-medium">Low Stock Threshold</label>
            <input type="number" id="low_stock_threshold" wire:model="low_stock_threshold" required min="0"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('low_stock_threshold') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                {{ $itemId ? 'Update Item' : 'Create Item' }}
            </button>

            <!-- Cancel Button -->
            <a href="{{ route('warehouse.warehouse-supervisor.item.dashboard') }}"
                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
