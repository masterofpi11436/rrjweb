<div class="p-6 space-y-4">

    <!-- Fiscal Year Filter -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 shadow-lg p-6">

        <h2 class="text-xl font-semibold text-white mb-6">
            Fiscal Year Report
        </h2>

        <div class="flex flex-wrap items-end justify-between gap-6">

            {{-- Left Side --}}
            <div class="flex flex-wrap items-end gap-4">

                <div>
                    <label for="fiscal-year" class="block text-sm font-medium text-gray-300 mb-2">
                        Fiscal Year
                    </label>

                    <select id="fiscal-year" wire:model="selectedYear"
                        class="rounded-md border border-gray-600 bg-gray-700 px-3 py-2 text-white focus:border-blue-500 focus:outline-none">
                        @foreach ($availableYears ?? [] as $year)
                            <option value="{{ $year }}">
                                {{ $year }} – {{ $year + 1 }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button wire:click="loadReportData"
                    class="rounded-md bg-blue-600 px-5 py-2 text-white transition hover:bg-blue-700">
                    Apply Filter
                </button>

            </div>

            {{-- Right Side --}}
            <div class="flex flex-wrap gap-3">

                <form method="POST" action="{{ route('warehouse.warehouse-supervisor.reports.fiscal.download') }}">
                    @csrf
                    <input type="hidden" name="year" value="{{ $selectedYear }}">

                    <button type="submit"
                        class="rounded-md bg-green-600 px-5 py-2 text-white transition hover:bg-green-700">
                        Download CSV
                    </button>
                </form>

                <form method="GET" action="{{ route('warehouse.warehouse-supervisor.reports.fiscal-year-graph') }}">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">

                    <button type="submit"
                        class="rounded-md bg-purple-600 px-5 py-2 text-white transition hover:bg-purple-700">
                        View Graph
                    </button>
                </form>

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
                        $allSections = collect($reportData)
                            ->flatMap(function ($entries) {
                                return collect($entries)->pluck('section');
                            })
                            ->unique()
                            ->sort()
                            ->values();
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
                        <td class="border border-gray-600 p-2 font-semibold">
                            {{ \Illuminate\Support\Str::title($displayNames[$item] ?? $item) }}</td>
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
