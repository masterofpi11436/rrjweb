@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Fiscal Year Graph')

@section('heading', 'Fiscal Year Graph')

@section('content')

    <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.fiscal-year-graph') }}" class="mb-6 flex gap-4 items-end">
        <div>
            <label for="year" class="block text-sm text-white mb-1">Year</label>
            <select name="year" id="year" class="p-2 rounded bg-gray-700 text-white">
                @for ($y = now()->year; $y >= now()->year - 4; $y--)
                    <option value="{{ $y }}" @selected($selectedYear == $y)>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Apply Filter
            </button>
        </div>

        <div class="ml-auto">
            <a href="{{ route('warehouse.warehouse-supervisor.reports.fiscal-year') }}"
               class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800">
                Back
            </a>
        </div>
    </form>

    <div style="overflow-x: auto;">
        <div style="height: {{ max(count($labels) * 30, 300) }}px;">
            <canvas id="fiscalReportChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        const ctx = document.getElementById('fiscalReportChart').getContext('2d');

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
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const itemName = this.data.labels[index];
                    const encodedItemName = encodeURIComponent(itemName);
                    const year = {{ $selectedYear }};
                    const url = `{{ route('warehouse.warehouse-supervisor.reports.fiscal-year-graph-item', ['id' => 'REPLACE']) }}`
                        .replace('REPLACE', encodedItemName) + `?year=${year}`;
                    window.location.href = url;
                }
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
