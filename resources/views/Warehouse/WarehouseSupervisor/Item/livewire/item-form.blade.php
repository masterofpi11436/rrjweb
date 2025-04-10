<div class="max-w-lg mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- Item Name -->
        <div>
            <label for="name" class="block text-gray-200 font-medium">Item</label>
            <input type="text" id="name" wire:model="name" required
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-200 font-medium">Description</label>
            <textarea id="description" wire:model="description" rows="4"
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400"
                placeholder="Enter item description..."></textarea>
            @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Category Dropdown -->
        <div>
            <label for="category_id" class="block text-gray-200 font-medium">Category</label>
            <select id="category_id" wire:model="category_id"
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload -->
        <div>
            <label for="image" class="block text-gray-200 font-medium">Image</label>
            <input type="file" id="image" wire:model="image"
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
            @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

            @if ($imagePreview)
                <div class="mt-3 flex flex-col items-center">
                    <img src="{{ $imagePreview }}" class="rounded-md shadow-md object-cover w-40 h-40">

                    @if ($imagePreview !== asset('images/default-image.jpg'))
                        <button type="button" wire:click="removeImage"
                            class="mt-2 px-4 py-1 bg-red-600 text-white rounded border border-red-700 hover:bg-red-700 hover:border-red-600">
                            Remove Image
                        </button>
                    @endif
                </div>
            @endif
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="block text-gray-200 font-medium">Quantity</label>
            <input type="number" id="quantity" wire:model="quantity" required min="0"
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
            @error('quantity') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Low Stock Threshold -->
        <div>
            <label for="low_stock_threshold" class="block text-gray-200 font-medium">Low Stock Threshold</label>
            <input type="number" id="low_stock_threshold" wire:model="low_stock_threshold" required min="0"
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500">
            @error('low_stock_threshold') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit & Cancel -->
        <div class="flex justify-between items-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-700 text-white border border-blue-600 rounded hover:bg-blue-800 hover:border-blue-700">
                {{ $itemId ? 'Update Item' : 'Create Item' }}
            </button>

            <a href="{{ route('warehouse.warehouse-supervisor.item.dashboard') }}"
                class="px-4 py-2 bg-red-700 text-white border border-red-600 rounded hover:bg-red-800 hover:border-red-700 inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
