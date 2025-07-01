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

    <div style="overflow-x: auto;">
        <div style="height: {{ max(count($labels) * 30, 300) }}px;">
            <canvas id="monthlyReportChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

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
                    borderWidth: 1,
                    categoryPercentage: 1.0,
                    barPercentage: 0.5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        right: 40
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Item Quantities',
                        font: { size: 20 }
                    },
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { font: { size: 14 } },
                        title: {
                            display: true,
                            text: 'Quantity',
                            font: { size: 16 }
                        }
                    },
                    y: {
                        offset: true,
                        ticks: {
                            autoSkip: false,
                            font: { size: 14 }
                        }
                    }
                }
            },
            plugins: [
                {
                    id: 'barValueLabels',
                    afterDatasetsDraw(chart) {
                        const { ctx } = chart;
                        const dataset = chart.data.datasets[0];
                        const meta = chart.getDatasetMeta(0);

                        ctx.save();
                        ctx.fillStyle = '#fff';
                        ctx.font = 'bold 14px sans-serif';
                        ctx.textAlign = 'left';

                        meta.data.forEach((bar, index) => {
                            const value = dataset.data[index];
                            const x = bar.x + 6;
                            const y = bar.y + bar.height / 2 + 5;
                            ctx.fillText(value, x, y);
                        });

                        ctx.restore();
                    }
                }
            ]
        });
    });
</script>
@endpush
