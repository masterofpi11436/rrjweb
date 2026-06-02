<div>
    <input
        type="text"
        wire:model.live="search"
        placeholder="Search camera..."
    >

    <table>
        <thead>
            <tr>
                <th>
                    <a href="#" wire:click.prevent="sortBy('camera_number')">
                        Camera#
                        @if ($sortColumn === 'camera_number')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('future_ip_address')">
                        Future IP Address
                        @if ($sortColumn === 'future_ip_address')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('is_used')">
                        In Use
                        @if ($sortColumn === 'is_used')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    Change in Use Status
                </th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                @php
                    $statusClass = match((int) $camera->is_used) {
                        1 => 'bg-green-100 text-green-800 border border-black rounded-full px-4 py-1 inline-block',
                        0 => 'bg-red-100 text-red-800 border border-black rounded-full px-4 py-1 inline-block'
                    };
                @endphp

                <tr>
                    <td>{{ $camera->camera_number }}</td>
                    <td>{{ $camera->future_ip_address }}</td>
                    <td>
                        <span class="{{ $statusClass }}">
                            {{ $camera->is_used ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button
                            wire:click="toggleUsed({{ $camera->id }})"
                        >
                            {{ $camera->is_used ? 'Mark Unused' : 'Mark Used' }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Camera Record Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
