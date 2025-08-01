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

            <!-- Filter Button -->
            <div>
                <button wire:click="loadReportData" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Apply Filter
                </button>
            </div>
        </div>

        <!-- View Graph Button -->
        <div class="flex flex-wrap justify-end gap-4 mt-4">
            <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.calendar-year-graph') }}">
                <input type="hidden" name="year" value="{{ $selectedYear }}">
                <button type="submit"
                    class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800">
                    View Calendar Year Graph
                </button>
            </form>
        </div>
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
