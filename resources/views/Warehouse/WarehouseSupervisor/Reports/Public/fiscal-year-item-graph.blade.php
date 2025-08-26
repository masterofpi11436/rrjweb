@extends('layouts.Public.warehouse-reports')

@section('title', 'Item Breakdown')
@section('heading', 'Item Breakdown')

@section('content')

    <form method="GET" action="{{ route('public.reports.fiscal-year-graph') }}" class="mb-6 flex gap-4 items-end">
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Back
            </button>
        </div>
    </form>

    {{-- NEW: Fiscal Year Monthly Trend (Jul -> Jun) --}}
    <div class="mb-8" style="overflow-x: auto;">
        <div style="height: 320px;">
            <canvas id="fiscalItemTrendChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

    {{-- Existing: Section Breakdown --}}
    <div style="overflow-x: auto;">
        <div style="height: {{ max(count($labels) * 30, 300) }}px;">
            <canvas id="fiscalItemChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script>
window.addEventListener('load', function () {
    // ====== NEW: Fiscal Monthly Trend (line) ======
    const trendCtx = document.getElementById('fiscalItemTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},  // ['Jul',...,'Jun']
            datasets: [{
                label: 'Total Quantity per Month (FY)',
                data: {!! json_encode($monthValues) !!},
                fill: false,
                borderWidth: 2,
                tension: 0.2,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Trend for "{{ $itemName }}" in FY {{ $selectedYear }}-{{ $selectedYear + 1 }}',
                    font: { size: 18 }
                },
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { ticks: { font: { size: 12 } } },
                y: {
                    beginAtZero: true,
                    ticks: { font: { size: 12 } },
                    title: { display: true, text: 'Quantity', font: { size: 14 } }
                }
            }
        }
    });

    // ====== Existing: Section Breakdown (bar) ======
    const ctx = document.getElementById('fiscalItemChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Quantity Ordered by Section',
                data: {!! json_encode($values) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                categoryPercentage: 1.0,
                barPercentage: 0.5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { right: 40 } },
            plugins: {
                title: {
                    display: true,
                    text: 'Section Breakdown for ' + {!! json_encode($itemName) !!},
                    font: { size: 20 }
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { font: { size: 14 } },
                    title: { display: true, text: 'Quantity', font: { size: 16 } }
                },
                y: {
                    offset: true,
                    ticks: { autoSkip: false, font: { size: 14 } }
                }
            }
        },
        plugins: [{
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
        }]
    });
});
</script>
@endpush
