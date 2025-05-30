@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Visit Times')

@section('heading', 'Jurisdiction Visit Times')

@section('content')

<a href="{{ route('jurisdiction.time-logs')}}">Time Logs</a>

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
                        window.location.href = `/jurisdiction/${encodedLabel}`;
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
