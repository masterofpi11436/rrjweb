<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Search Bar -->
    <div class="flex justify-center mb-6">
        <div class="relative w-full md:w-2/3">
            <input type="text" wire:model.live="search"
                   placeholder="Search items..."
                   class="w-full p-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <span class="absolute left-3 top-3 text-gray-400">
                🔍
            </span>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border px-6 py-3 cursor-pointer text-left" wire:click="sortBy('name')">
                        Name
                        @if ($sortColumn === 'name')
                            <span>{{ $sortDirection === 'asc' ? '⬆️' : '⬇️' }}</span>
                        @endif
                    </th>
                    <th class="border px-6 py-3 cursor-pointer text-left" wire:click="sortBy('category_id')">
                        Category
                        @if ($sortColumn === 'category_id')
                            <span>{{ $sortDirection === 'asc' ? '⬆️' : '⬇️' }}</span>
                        @endif
                    </th>
                    <th class="border px-6 py-3 cursor-pointer text-left" wire:click="sortBy('quantity')">
                        Quantity
                        @if ($sortColumn === 'quantity')
                            <span>{{ $sortDirection === 'asc' ? '⬆️' : '⬇️' }}</span>
                        @endif
                    </th>
                    <th class="border px-6 py-3 cursor-pointer text-left" wire:click="sortBy('stock_status')">
                        Stock Status
                        @if ($sortColumn === 'stock_status')
                            <span>{{ $sortDirection === 'asc' ? '⬆️' : '⬇️' }}</span>
                        @endif
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($items as $item)
                    @php
                        // Determine row color based on stock levels
                        if ($item->quantity <= $item->low_stock_threshold / 2) {
                            $status = ['bg-red-100 text-red-800 border-red-400', '❌ Critical'];
                        } elseif ($item->quantity <= $item->low_stock_threshold) {
                            $status = ['bg-yellow-100 text-yellow-800 border-yellow-400', '⚠️ Low'];
                        } else {
                            $status = ['bg-green-100 text-green-800 border-green-400', '✅ Sufficient'];
                        }
                    @endphp

                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="border px-6 py-3">{{ $item->name }}</td>
                        <td class="border px-6 py-3">{{ $item->category->category ?? 'N/A' }}</td>
                        <td class="border px-6 py-3">{{ $item->quantity }}</td>
                        <td class="border px-6 py-3">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full border {{ $status[0] }}">
                                {{ $status[1] }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">No items found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
