<div class="p-6 space-y-4">

    <!-- Filters -->
    <div class="flex gap-4 flex-wrap">
        <select wire:model="selectedYear">
            @for ($y = now()->year; $y >= now()->year - 4; $y--)
                <option class="text-black" value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>

        <select wire:model="selectedMonth">
            @for ($m = 1; $m <= 12; $m++)
                <option class="text-black" value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
            @endfor
        </select>

        <button wire:click="loadReportData" class="px-4 py-2 bg-blue-600 text-white rounded">
            Filter
        </button>
    </div>

    <button wire:click="sendMonthlyReport"
        class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
        Email Monthyly Report
    </button>

    {{-- Download the monthly report --}}
    <form method="POST" action="{{ route('warehouse.warehouse-supervisor.reports.monthly.download') }}">
        @csrf
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
            Download Monthly Report (CSV)
        </button>
    </form>

    <!-- Report Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-600 text-white">
            <thead class="bg-gray-800">
                <tr>
                    <th class="border border-gray-600 p-2">Item Name</th>
                    @foreach (collect($orders)->pluck('section_name')->filter()->unique() as $section)
                        <th class="border border-gray-600 p-2">{{ $section }}</th>
                    @endforeach
                    <th class="border border-gray-600 p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $item => $entries)
                    <tr class="bg-gray-900">
                        <td class="border border-gray-600 p-2 font-semibold">{{ $item }}</td>
                        @php
                            $sectionCounts = $entries->groupBy('section')->map->sum('quantity');
                            $total = $sectionCounts->sum();
                        @endphp
                        @foreach (collect($orders)->pluck('section_name')->filter()->unique() as $section)
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
