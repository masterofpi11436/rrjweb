@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Compliance Times')

@section('heading', 'Jurisdiction Compliance Times')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<a href="{{ route('jurisdiction.time-logs')}}">Time Logs</a>

<canvas id="complianceChart" width="400" height="200"></canvas>

@endsection

@push('scripts')
<script>
    window.addEventListener('load', function () {

        const canvas = document.getElementById('complianceChart');

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
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Average Time per Jurisdiction',
                        font: {
                            size: 20 // ← title font size
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 16 // ← legend label size
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
                                size: 16 // ← y-axis title size
                            }
                        },
                        ticks: {
                            font: {
                                size: 14 // ← y-axis tick label size
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 14 // ← x-axis tick label size
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
