<div>
    <h1>Time Log Table</h1>

    <table>
        <thead>
            <tr>
                <th>Jurisdiction</th>
                <th>Visit Date</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Magistrate</th>
                <th>Nurse</th>
                <th>Rejected</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $log->jurisdiction->name ?? 'N/A' }}</td>
                    <td>{{ $log->date_of_visit }}</td>
                    <td>{{ $log->arrival_time }}</td>
                    <td>{{ $log->departure_time }}</td>
                    <td>
                        {{ $log->magistrate_start ?? '-' }} – {{ $log->magistrate_end ?? '-' }}
                    </td>
                    <td>
                        {{ $log->nurse_start ?? '-' }} – {{ $log->nurse_end ?? '-' }}
                    </td>
                    <td >{{ $log->did_not_get_committed ? 'Yes' : 'No' }}</td>
                    <td >{{ $log->note ?? '-' }}</td>
                    <td>
                        <a href="{{ route('jurisdiction.edit-time-log', $log->id) }}">Edit</a>

                        <button wire:click="deleteLog({{ $log->id }})"
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure?')">
                                Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No time logs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
