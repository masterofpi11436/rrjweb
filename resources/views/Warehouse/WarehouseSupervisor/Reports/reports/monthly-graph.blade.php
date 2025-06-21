@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Monthly Report Graph')

@section('heading', 'Monthly Report Graph')

@section('content')

    <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.monthly-graph') }}" class="mb-6 flex gap-4 items-end">
        <div>
            <label for="year" class="block text-sm text-white mb-1">Year</label>
            <select name="year" id="year" class="p-2 rounded bg-gray-700 text-white">
                @for ($y = now()->year; $y >= now()->year - 4; $y--)
                    <option value="{{ $y }}" @selected($selectedYear == $y)>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label for="month" class="block text-sm text-white mb-1">Month</label>
            <select name="month" id="month" class="p-2 rounded bg-gray-700 text-white">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" @selected($selectedMonth == $m)>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Apply Filter
            </button>
        </div>
    </form>

    <canvas id="monthlyReportChart" width="600" height="300"></canvas>

@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        const ctx = document.getElementById('monthlyReportChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Quantity Ordered',
                    data: {!! json_encode($values) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Item Quantities',
                        font: { size: 20 }
                    },
                    legend: {
                        labels: { font: { size: 16 } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantity',
                            font: { size: 16 }
                        },
                        ticks: { font: { size: 14 } }
                    },
                    x: {
                        ticks: { font: { size: 14 } }
                    }
                }
            }
        });
    });
</script>
@endpush
