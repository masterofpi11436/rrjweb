@extends('layouts.jurisdiction')

@section('title', "Stats for $jurisdictionName")

@section('heading', "Average Times for $jurisdictionName")

@section('content')

<a href="{{ route('jurisdiction.dashboard') }}"
    style="float: left; display: inline-block; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 4px;">
    Graphs
</a>

<canvas id="roleChart" width="400" height="200"></canvas>

@endsection

@push('scripts')
<script>
window.addEventListener('load', function () {
    const ctx = document.getElementById('roleChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Avg Time (Minutes)',
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'white',
                borderWidth: 2,
                data: {!! json_encode($values) !!}
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Average Time by Role',
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
                    ticks: {
                        font: { size: 14 }
                    }
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
