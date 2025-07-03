@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Item Breakdown')

@section('heading', 'Item Breakdown')

@section('content')

    <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.monthly-graph') }}" class="mb-6 flex gap-4 items-end">
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Back
            </button>
        </div>
    </form>

    <div style="overflow-x: auto;">
        <div style="height: {{ max(count($labels) * 30, 300) }}px;">
            <canvas id="monthlyReportChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script>

</script>

@endpush
