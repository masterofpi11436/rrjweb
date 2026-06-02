<div>
    <h1>
        Gateway: 192.168.30.200<br>
        Subnet: 255.255.252.0
    </h1>
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
                    Is IP Address Used
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
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input
                                type="checkbox"
                                wire:click="toggleUsed({{ $camera->id }})"
                                class="peer sr-only"
                                {{ $camera->is_used ? 'checked' : '' }}
                            >

                            <div
                                class="h-6 w-10 rounded-full bg-gray-300 transition-colors duration-300
                                    peer-checked:bg-green-500
                                    after:absolute after:left-[3px] after:top-[3px]
                                    after:h-[18px] after:w-[18px]
                                    after:rounded-full after:bg-gray-500
                                    after:transition-all after:duration-300
                                    peer-checked:after:translate-x-4
                                    peer-checked:after:bg-white"
                            ></div>
                        </label>
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
