<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Time Log Table</h1>

    <table class="w-full table-auto border border-gray-700">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="p-2 border">Jurisdiction</th>
                <th class="p-2 border">Visit Date</th>
                <th class="p-2 border">Arrival</th>
                <th class="p-2 border">Departure</th>
                <th class="p-2 border">Magistrate</th>
                <th class="p-2 border">Nurse</th>
                <th class="p-2 border">Rejected</th>
                <th class="p-2 border">Note</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr class="border-t border-gray-600">
                    <td class="p-2 border">{{ $log->jurisdiction->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $log->date_of_visit }}</td>
                    <td class="p-2 border">{{ $log->arrival_time }}</td>
                    <td class="p-2 border">{{ $log->departure_time }}</td>
                    <td class="p-2 border">
                        {{ $log->magistrate_start ?? '-' }} – {{ $log->magistrate_end ?? '-' }}
                    </td>
                    <td class="p-2 border">
                        {{ $log->nurse_start ?? '-' }} – {{ $log->nurse_end ?? '-' }}
                    </td>
                    <td class="p-2 border">{{ $log->did_not_get_committed ? 'Yes' : 'No' }}</td>
                    <td class="p-2 border">{{ $log->note ?? '-' }}</td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('jurisdiction.edit-time-log', $log->id) }}"
                            class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                        <button wire:click="deleteLog({{ $log->id }})"
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="p-2 text-center">No time logs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
