<div class="p-6 space-y-4">

    <!-- Fiscal Year Filter -->
    <div class="bg-gray-800 p-4 rounded-md shadow-sm border border-gray-700">
        <h2 class="text-lg font-semibold text-white mb-4">Filter by Fiscal Year</h2>

        <div class="flex flex-wrap gap-4 items-end">
            <!-- Fiscal Year Dropdown -->
            <div>
                <label for="fiscal-year" class="block text-sm text-gray-300 mb-1">Fiscal Year</label>
                <select id="fiscal-year" wire:model="selectedYear"
                    class="p-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach ($availableYears ?? [] as $year)
                        <option value="{{ $year }}">{{ $year }} – {{ $year + 1 }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div>
                <button wire:click="loadReportData"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Apply Filter
                </button>
            </div>
        </div>
    </div>

    <p class="text-sm text-gray-400">
        Showing data from
        {{ \Carbon\Carbon::create($selectedYear, 7, 1)->format('F j, Y') }}
        to
        {{ \Carbon\Carbon::create($selectedYear + 1, 6, 30)->format('F j, Y') }}
    </p>

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
