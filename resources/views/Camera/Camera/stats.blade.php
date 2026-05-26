@extends('layouts.Public.camera')

@section('title', 'Camera Statistics')

@section('heading', 'Camera Statistics')

@section('content')

<a href="{{ route('camera.index') }}">View List</a><br>

<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:24px; margin-top:24px;">
    <div>
        <h3>Cameras by Status</h3>
        <canvas id="statusChart"></canvas>
    </div>

    {{-- <div>
        <h3>Cameras by NVR</h3>
        <canvas id="nvrChart"></canvas>
    </div> --}}

    <div>
        <h3>Cameras by Type</h3>
        <canvas id="typeChart"></canvas>
    </div>

    {{-- <div>
        <h3>Cameras by Model</h3>
        <canvas id="modelChart"></canvas>
    </div>

    <div>
        <h3>Cameras by Location</h3>
        <canvas id="locationChart"></canvas>
    </div>

    <div>
        <h3>Cameras by Encoder Switch</h3>
        <canvas id="switchChart"></canvas>
    </div> --}}
</div>

@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cameras = @json($cameras);

        function countBy(field, fallback = 'Unknown') {
            return cameras.reduce((acc, camera) => {
                const key = camera[field] || fallback;
                acc[key] = (acc[key] || 0) + 1;
                return acc;
            }, {});
        }

        function makeChart(canvasId, label, dataObject, type = 'bar') {
            const canvas = document.getElementById(canvasId);

            if (!canvas) return;

            new Chart(canvas, {
                type,
                data: {
                    labels: Object.keys(dataObject),
                    datasets: [{
                        label,
                        data: Object.values(dataObject),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: type === 'bar' ? {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    } : {}
                }
            });
        }

        makeChart('statusChart', 'Status', countBy('status'), 'doughnut');
        makeChart('nvrChart', 'NVR', countBy('nvr'), 'pie');
        makeChart('typeChart', 'Camera Type', countBy('camera_type'), 'bar');
        makeChart('modelChart', 'Camera Model', countBy('camera_model'), 'bar');
        makeChart('locationChart', 'Location', countBy('location'), 'bar');
        makeChart('switchChart', 'Encoder Switch', countBy('encoder_switch_name'), 'bar');
    });
    </script>
@endpush

@endsection
