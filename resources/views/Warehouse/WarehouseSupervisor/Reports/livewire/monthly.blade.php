<div class="p-6 space-y-4">

    <!-- Filters -->
    <div class="bg-gray-800 p-4 rounded-md shadow-sm border border-gray-700">
        <h2 class="text-lg font-semibold text-white mb-4">Filter by Month & Year</h2>

        <div class="flex flex-wrap gap-4 items-end">
            <!-- Year Dropdown -->
            <div>
                <label for="year" class="block text-sm text-gray-300 mb-1">Year</label>
                <select id="year" wire:model="selectedYear" class="p-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:border-blue-500">
                    @for ($y = now()->year; $y >= now()->year - 4; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <!-- Month Dropdown -->
            <div>
                <label for="month" class="block text-sm text-gray-300 mb-1">Month</label>
                <select id="month" wire:model="selectedMonth" class="p-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:border-blue-500">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endfor
                </select>
            </div>

            <!-- Filter Button -->
            <div>
                <button wire:click="loadReportData" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Apply Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Action Buttons Bar -->
    <div class="flex flex-wrap justify-end gap-4 mb-4">
        <button wire:click="emailMonthlyReport"
            class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
            Email Monthly Report
        </button>

        <a href="{{ route('warehouse.warehouse-supervisor.reports.monthly.dashboard') }}"
            class="px-4 py-2 bg-blue-700 text-white border border-blue-600 rounded hover:bg-blue-800 hover:border-blue-700">
            Recipient List
        </a>

        <form method="POST" action="{{ route('warehouse.warehouse-supervisor.reports.monthly.download') }}">
            @csrf
            <input type="hidden" name="year" value="{{ $selectedYear }}">
            <input type="hidden" name="month" value="{{ $selectedMonth }}">
            <button type="submit"
                class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
                Download Monthly Report (CSV)
            </button>
        </form>

        <!-- View Graph Button -->
        <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.monthly-graph') }}">
            <input type="hidden" name="month" value="{{ $selectedMonth }}">
            <input type="hidden" name="year" value="{{ $selectedYear }}">
            <button type="submit"
                class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800">
                View Monthly Graph
            </button>
        </form>

    </div>

    <!-- Report Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-600 text-white">
            <thead class="bg-gray-800">
                <tr>
                    <th class="border border-gray-600 p-2">Item Name</th>
                    @php
                        $allSections = collect($reportData)->flatMap(function ($entries) {
                            return collect($entries)->pluck('section');
                        })->unique()->sort()->values();
                    @endphp
                    @foreach ($allSections as $section)
                        <th class="border border-gray-600 p-2 text-center">{{ $section }}</th>
                    @endforeach
                    <th class="border border-gray-600 p-2 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $item => $entries)
                    <tr class="bg-gray-900">
                        <td class="border border-gray-600 p-2 font-semibold">{{ \Illuminate\Support\Str::title($displayNames[$item] ?? $item) }}</td>
                        @php
                            $sectionCounts = $entries->groupBy('section')->map->sum('quantity');
                            $total = $sectionCounts->sum();
                        @endphp
                        @foreach ($allSections as $section)
                            <td class="border border-gray-600 p-2 text-center">
                                {{ $sectionCounts[$section] ?? '' }}
                            </td>
                        @endforeach
                        <td class="border border-gray-600 p-2 text-center font-bold">{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
