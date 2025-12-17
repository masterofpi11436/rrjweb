@extends('layouts.jurisdiction')

@section('title', "Stats for $jurisdictionName")

@section('heading', "Average Times for $jurisdictionName")

@section('content')

<div style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
    <a href="{{ route('jurisdiction.dashboard') }}"
       style="display:inline-block; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 4px;">
        Graphs
    </a>

    <label for="range" style="font-weight:600;">Range</label>

    <select id="range" name="range" style="padding:8px 10px; border-radius:6px;">
        <option value="week"  @selected(($range ?? 'all') === 'week')>Last 7 Days</option>
        <option value="month" @selected(($range ?? 'all') === 'month')>Last 30 Days</option>
        <option value="all"   @selected(($range ?? 'all') === 'all')>All time</option>
    </select>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('range');

    sel.addEventListener('change', async () => {
        await fetch('{{ route('jurisdiction.set-range') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ range: sel.value })
        });

        window.location.reload(); // stays on same drilldown label, no URL params
    });
});
</script>

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
