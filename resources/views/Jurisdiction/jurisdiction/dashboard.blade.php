@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Visit Times')

@section('heading', 'Jurisdiction Visit Times')

@section('content')

<div style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
    <a href="{{ route('jurisdiction.time-logs') }}"
       style="display:inline-block; padding:8px 16px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
        Time Logs
    </a>

    <label for="range" style="font-weight:600;">Range</label>

    <select id="range" name="range"
            style="padding:8px 10px; border-radius:6px;"
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
                datasets: [{
                    label: 'Avg Time (Minutes)',
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // light blue fill
                    borderColor: 'white',       // solid blue border
                    borderWidth: 2,
                    data: {!! json_encode($values) !!}
                }]
            },
            options: {
                onClick: function (evt, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const label = this.data.labels[index];
                        const encodedLabel = encodeURIComponent(label);
                        window.location.href = `/jurisdiction/jurisdiction-graph/${encodedLabel}`;
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Average Time per Jurisdiction',
                        font: {
                            size: 20
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Minutes',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }

        });
    });
</script>
@endpush
