<div class="bg-gray-900 text-gray-100 p-6 rounded-lg shadow">

    <!-- Back Button -->
    @if ($order->status === 'approved')
        <a href="{{ route('warehouse.warehouse-supervisor.history.approved') }}" class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">Back</a>
    @elseif ($order->status === 'exchange_approved')
        <a href="{{ route('warehouse.warehouse-supervisor.approved-exchange') }}" class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">Back</a>
    @elseif ($order->status === 'denied')
        <a href="{{ route('warehouse.warehouse-supervisor.history.denied') }}" class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">Back</a>
    @elseif ($order->status === 'exchange_denied')
        <a href="{{ route('warehouse.warehouse-supervisor.denied-exchange') }}" class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">Back</a>
    @else
        <a href="{{ url()->previous() }}" class="mb-4 inline-block bg-gray-800 text-white border border-red-600 px-2 py-2 text-sm font-semibold rounded-md hover:bg-gray-700">Back</a>
    @endif

    <div id="printableArea">
        <h2 class="text-2xl font-bold mb-4">Order #{{ $order->order_number }}</h2>

        <p><strong>Created At:</strong> {{ $order->created_at }}</p>
        <p><strong>Status:</strong> {{ config('orderstatus.labels.' . $order->status, ucfirst(str_replace('_', ' ', $order->status))) }}</p>
        <p><strong>Supervisor:</strong> {{ $order->supervisor }}</p>
        <p><strong>Section:</strong> {{ $order->section }}</p>
        @if (property_exists($order, 'note') && !empty($order->note))
            <div class="mt-6 bg-gray-800 border border-gray-700 rounded p-4">
                <h3 class="text-lg font-semibold text-yellow-400 mb-2">Note</h3>
                <p class="text-sm text-gray-300 whitespace-pre-line">{{ $order->note }}</p>
            </div>
        @endif

        @if (!empty($items))
            <h3 class="text-xl font-semibold mt-6 mb-2">Items in this Order</h3>
            <table class="w-full text-sm border border-gray-700">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="text-left p-2 border-b border-gray-700">Name</th>
                        <th class="text-left p-2 border-b border-gray-700">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-700">
                            <td class="p-2 border-b border-gray-700">{{ $item['name'] }}</td>
                            <td class="p-2 border-b border-gray-700">{{ $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-4 flex flex-wrap gap-4">
        @if ($this->source === 'new' && $this->order?->status === 'approved')
            <a href="{{ route('warehouse.warehouse-supervisor.edit-approved-order', ['orderId' => $this->orderId]) }}"
               class="w-32 text-center px-4 py-2 bg-yellow-600 text-white text-sm border border-yellow-500 rounded hover:bg-yellow-700">
                Edit Order
            </a>
        @endif

        <button onclick="printOrder()"
                class="w-32 px-4 py-2 bg-gray-700 text-white text-sm border border-gray-600 rounded hover:bg-gray-800">
            Print
        </button>
    </div>


    <script>
        function printOrder() {
            var printContent = document.getElementById("printableArea").innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</div>
