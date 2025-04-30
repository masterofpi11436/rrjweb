<div class="max-w-6xl mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700 min-h-screen">
    <!-- Search Bar -->
    <div class="flex justify-center mb-6">
        <div class="relative w-full md:w-2/3">
            <input type="text" wire:model.live="search"
                   placeholder="Search items..."
                   class="w-full p-3 pl-10 bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:outline-none focus:border-blue-500 placeholder-gray-400">
            <span class="absolute left-3 top-3 text-gray-400">
                🔍
            </span>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-700 border-b border-gray-600 text-left">
                    <th class="p-3 cursor-pointer" wire:click="sortBy('name')">
                        <a href="#" class="text-blue-400 hover:text-blue-300 underline">
                            Name
                            @if ($sortColumn === 'name')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>
                    <th class="p-3 cursor-pointer" wire:click="sortBy('category_id')">
                        <a href="#" class="text-blue-400 hover:text-blue-300 underline">
                            Category
                            @if ($sortColumn === 'category_id')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>
                    <th class="p-3 cursor-pointer" wire:click="sortBy('quantity')">
                        <a href="#" class="text-blue-400 hover:text-blue-300 underline">
                            Quantity
                            @if ($sortColumn === 'quantity')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>
                    <th class="p-3 cursor-pointer" wire:click="sortBy('stock_status')">
                        <a href="#" class="text-blue-400 hover:text-blue-300 underline">
                            Stock Status
                            @if ($sortColumn === 'stock_status')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($items as $item)
                    @php
                        if ($item->quantity <= $item->low_stock_threshold / 2) {
                            $status = ['bg-red-800 text-red-300 border-red-500', '❌ Critical'];
                        } elseif ($item->quantity <= $item->low_stock_threshold) {
                            $status = ['bg-yellow-700 text-yellow-200 border-yellow-500', '⚠️ Low'];
                        } else {
                            $status = ['bg-green-800 text-green-300 border-green-500', '✅ Sufficient'];
                        }
                    @endphp

                    <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                        <td class="p-3">{{ $item->name }}</td>
                        <td class="p-3">{{ $item->category->category ?? 'N/A' }}</td>
                        <td class="p-3">{{ $item->quantity }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full border {{ $status[0] }}">
                                {{ $status[1] }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-400">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
