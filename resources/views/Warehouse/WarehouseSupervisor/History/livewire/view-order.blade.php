<div class="bg-gray-900 text-gray-100 p-6 rounded-lg shadow">

    <!-- Back Button -->
    <a href="{{ url()->previous() }}"
        class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">
        Back
    </a>

    <h2 class="text-2xl font-bold mb-4">Order #{{ $order->order_number }}</h2>

    <p><strong>Created At:</strong> {{ $order->created_at }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Supervisor:</strong> {{ $order->supervisor }}</p>
    <p><strong>Section:</strong> {{ $order->section }}</p>

    @if (!empty($items))
        <h3 class="text-xl font-semibold mt-6 mb-2">Items in this Order</h3>
        <table class="w-full text-sm border border-gray-700">
            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th class="text-left p-2 border-b border-gray-700">Item ID</th>
                    <th class="text-left p-2 border-b border-gray-700">Name</th>
                    <th class="text-left p-2 border-b border-gray-700">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="hover:bg-gray-700">
                        <td class="p-2 border-b border-gray-700">{{ $item['id'] }}</td>
                        <td class="p-2 border-b border-gray-700">{{ $item['name'] }}</td>
                        <td class="p-2 border-b border-gray-700">{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
