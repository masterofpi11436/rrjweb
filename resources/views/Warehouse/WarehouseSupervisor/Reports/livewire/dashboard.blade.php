<div>
    <div class="report-controls">
        <label for="reportType">Select Report:</label>
        <select wire:model="reportType" id="reportType">
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly</option>
            <option value="yearly">Yearly</option>
        </select>

        <button wire:click="exportCsv">Export CSV</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Supervisor</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->supervisor }}</td>
                    <td>{{ $order->section }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
