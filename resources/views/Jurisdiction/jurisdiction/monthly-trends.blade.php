@extends('layouts.jurisdiction')

@section('title', 'Monthly Trends')
@section('heading', 'Monthly Trends')

@section('content')

    <div style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <a href="{{ route('jurisdiction.dashboard') }}"
            style="padding:8px 16px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
            Graphs
        </a>

        {{-- Preset range --}}
        <form method="GET" action="{{ route('jurisdiction.monthly-trends') }}" id="presetForm">
            <input type="hidden" name="from" value="">
            <input type="hidden" name="to" value="">
            <select name="range" onchange="document.getElementById('presetForm').submit()"
                style="padding:8px 10px; border-radius:4px; border:1px solid #ccc;">
                <option value="7"  {{ ($range ?? '30') === '7' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="30" {{ ($range ?? '30') === '30' ? 'selected' : '' }}>Last 30 Days</option>
                <option value="all" {{ ($range ?? '30') === 'all' ? 'selected' : '' }}>All Time</option>
            </select>
        </form>

        <form method="GET" action="{{ route('jurisdiction.monthly-trends') }}"
            style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

            <input type="hidden" name="range" value="{{ $range ?? '30' }}">
            <input type="hidden" name="from" value="{{ $from ?? '' }}">
            <input type="hidden" name="to" value="{{ $to ?? '' }}">

            {{-- Jurisdiction --}}
            <select name="jurisdiction_id"
                    onchange="this.form.submit()"
                    style="padding:8px 10px; border-radius:4px; border:1px solid #ccc;">
                <option value="">All Jurisdictions</option>
                @foreach ($jurisdictions as $jurisdiction)
                    <option value="{{ $jurisdiction->id }}"
                        {{ (string)$jurisdictionId === (string)$jurisdiction->id ? 'selected' : '' }}>
                        {{ $jurisdiction->name }}
                    </option>
                @endforeach
            </select>

            {{-- From --}}
            <label>
                From
                <input type="date" name="from" value="{{ $from ?? '' }}">
            </label>

            {{-- To --}}
            <label>
                To
                <input type="date" name="to" value="{{ $to ?? '' }}">
            </label>

            <button type="submit"
                    style="padding:8px 14px; background:#28a745; color:#fff; border:none; border-radius:4px;">
                Apply
            </button>

            <a href="{{ route('jurisdiction.monthly-trends') }}"
            style="padding:8px 14px; background:#6c757d; color:#fff; text-decoration:none; border-radius:4px;">
                Reset
            </a>
        </form>
    </div>

    <canvas id="monthlyTrendChart" height="120"></canvas>
@endsection

@push('scripts')
<script>
window.addEventListener('load', function () {
    const range = @json($range ?? '30');

    const ctx = document.getElementById('monthlyTrendChart').getContext('2d');

    const titleText =
        range === '7'  ? 'Average Visit Time per Day (Last 7 Days)' :
        range === '30' ? 'Average Visit Time per Day (Last 30 Days)' :
                         'Average Visit Time per Day (All Time)';

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
                    text: titleText,
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
