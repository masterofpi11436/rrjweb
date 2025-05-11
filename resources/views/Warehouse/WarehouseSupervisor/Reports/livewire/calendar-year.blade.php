<div class="p-6 space-y-4">

    <!-- Filters -->
    <div class="flex gap-4 flex-wrap">
        <select wire:model="selectedYear">
            @foreach ($availableYears ?? [] as $year)
                <option class="text-black" value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>

        <button wire:click="loadReportData" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-800">
            Filter
        </button>
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
