@extends('layouts.jurisdiction')

@section('title', 'Monthly Trends')
@section('heading', 'Monthly Trends (Last 30 Days)')

@section('content')
    <canvas id="monthlyTrendChart" height="120"></canvas>
@endsection

<a href="{{ route('jurisdiction.dashboard') }}"
    style="padding:8px 16px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
    Graphs
</a>

@push('scripts')
<script>
window.addEventListener('load', function () {
    const ctx = document.getElementById('monthlyTrendChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Avg Visit Time (Minutes)',
                data: {!! json_encode($values) !!},
                spanGaps: true,
                tension: 0.25,
                borderWidth: 2,
                pointRadius: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Average Visit Time per Day (Last 30 Days)',
                    font: { size: 18 }
                },
                legend: {
                    labels: { font: { size: 14 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Minutes', font: { size: 14 } }
                },
                x: {
                    ticks: { maxRotation: 0, autoSkip: true, maxTicksLimit: 10 }
                }
            }
        }
    });
});
</script>
@endpush
