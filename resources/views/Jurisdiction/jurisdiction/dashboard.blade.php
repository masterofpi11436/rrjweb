@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Visit Times')

@section('heading', 'Jurisdiction Visit Times')

@section('content')

<div style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
    <a href="{{ route('jurisdiction.time-logs') }}"
       style="padding:8px 16px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
        Time Logs
    </a>

    <a href="{{ route('jurisdiction.monthly-trends') }}"
       style="padding:8px 16px; background:#28a745; color:#fff; text-decoration:none; border-radius:4px;">
        Monthly Trends
    </a>

    <label for="range" style="font-weight:600;">Range</label>

    <select id="range"
            onchange="location.href='{{ route('jurisdiction.dashboard') }}?range=' + this.value;">
        <option value="week"  @selected(($range ?? 'all') === 'week')>Last 7 Days</option>
        <option value="month" @selected(($range ?? 'all') === 'month')>Last 30 Days</option>
        <option value="all"   @selected(($range ?? 'all') === 'all')>All time</option>
    </select>
</div>

<canvas id="timeLogChart" width="400" height="200"></canvas>

@endsection

@push('scripts')

<script>
window.addEventListener('load', function () {
    const canvas = document.getElementById('timeLogChart');
    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Overall',
                    data: {!! json_encode($overall) !!}
                },
                {
                    label: 'Magistrate',
                    data: {!! json_encode($magistrate) !!}
                },
                {
                    label: 'Nurse',
                    data: {!! json_encode($nurse) !!}
                },
                {
                    label: 'Officer',
                    data: {!! json_encode($officer) !!}
                }
            ]
        },
        options: {
            onClick: function (evt, elements) {
                if (elements.length > 0) {
                    const index = elements[0].index; // jurisdiction index
                    const label = this.data.labels[index];
                    window.location.href = `/jurisdiction/jurisdiction-graph/${encodeURIComponent(label)}`;
                }
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Average Time per Jurisdiction',
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
                        text: 'Minutes',
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
