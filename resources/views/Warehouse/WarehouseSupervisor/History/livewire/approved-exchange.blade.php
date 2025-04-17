<div>

    <!-- Back Button -->
    <a href="{{ route('warehouse.warehouse-supervisor.history.dashboard') }}"
    class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">
        Back
    </a>

    <input type="text" placeholder="Search orders..." wire:model.live="search"
        class="mb-4 p-2 w-full rounded bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-400"/>

    <div class="bg-gray-900 text-gray-100 p-6 rounded-lg shadow">

        <table class="w-full text-sm text-left border border-gray-700">
            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('order_number')">
                            Order Number
                            @if ($sortField === 'order_number')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('created_at')">
                            created_at
                            @if ($sortField === 'created_at')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('supervisor')">
                            supervisor
                            @if ($sortField === 'supervisor')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('section')">
                            section
                            @if ($sortField === 'section')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-700">
                        <td class="p-2 border-b border-gray-700">{{ $order->order_number }}</td>
                        <td class="p-2 border-b border-gray-700">{{ $order->created_at }}</td>
                        <td class="p-2 border-b border-gray-700">{{ $order->supervisor }}</td>
                        <td class="p-2 border-b border-gray-700">{{ $order->section }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-400">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
