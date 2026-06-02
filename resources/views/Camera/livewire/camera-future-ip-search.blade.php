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
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                <tr>
                    <td>{{ $camera->camera_number }}</td>
                    <td>{{ $camera->future_ip_address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Camera Record Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
