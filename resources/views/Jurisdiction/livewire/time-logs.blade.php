<div>

    <div>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search jurisdiction or note..." />
    </div>

    <h1>Time Log Table</h1>

    <table>
        <thead>
            <tr>
                <th>
                    <a href="#" wire:click.prevent="sortBy('jurisdictions.name')">
                            Jurisdiction
                        @if ($sortColumn === 'jurisdictions.name')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('date_of_visit')">
                        Visit Date
                        @if ($sortColumn === 'date_of_visit')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('arrival_time')">
                        Arrival
                        @if ($sortColumn === 'arrival_time')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>Departure</th>
                <th>Booking</th>
                <th>Magistrate</th>
                <th>Nurse</th>
                <th>Officer</th>
                <th>Not Committed</th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('inmate_count')">
                        Inmates Received
                        @if ($sortColumn === 'inmate_count')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('note')">
                        Note
                        @if ($sortColumn === 'note')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
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
                        {{ $log->booking_start ?? '-' }} – {{ $log->booking_end ?? '-' }}
                    </td>
                    <td>
                        {{ $log->magistrate_start ?? '-' }} – {{ $log->magistrate_end ?? '-' }}
                    </td>
                    <td>
                        {{ $log->nurse_start ?? '-' }} – {{ $log->nurse_end ?? '-' }}
                    </td>
                    <td>
                        {{ $log->officer_start ?? '-' }} – {{ $log->officer_end ?? '-' }}
                    </td>
                    <td >{{ $log->did_not_get_committed ? 'Yes' : 'No' }}</td>
                    <td>{{ $log->inmate_count }}</td>
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
