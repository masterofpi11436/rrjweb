<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Search Bar -->
    <div class="flex justify-between items-center mb-6">
        <input type="text" wire:model.live="search" placeholder="Search Items..."
            class="w-full md:w-2/3 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >
    </div>

    <!-- Categories Filter -->
    <div class="mb-4">
        <label class="font-semibold text-gray-700">Filter by Category:</label>
        <select wire:model="selectedCategory"
            class="p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
        </select>
    </div>

    <!-- Items Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <img src="{{ $item->image ?? asset('images/default-image.jpg') }}" alt="{{ $item->name }}"
                    class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->category->category ?? 'No Category' }}</p>

                    <button wire:click="addToCart({{ $item->id }})"
                        class="mt-3 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                No items found.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $items->links() }}
    </div>
</div>
