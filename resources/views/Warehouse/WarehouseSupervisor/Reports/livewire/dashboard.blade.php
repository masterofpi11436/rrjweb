<div class="bg-gray-900 text-gray-100 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">All Orders</h2>

    <table class="w-full text-sm text-left border border-gray-700">
        <thead class="bg-gray-800 text-gray-300">
            <tr>
                <th class="p-2 border-b border-gray-700">Order #</th>
                <th class="p-2 border-b border-gray-700">Created At</th>
                <th class="p-2 border-b border-gray-700">Supervisor</th>
                <th class="p-2 border-b border-gray-700">Section</th>
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
