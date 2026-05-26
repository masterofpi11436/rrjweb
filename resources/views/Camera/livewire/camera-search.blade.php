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
                    <a href="#" wire:click.prevent="sortBy('camera_name')">
                        Name
                        @if ($sortColumn === 'camera_name')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('camera_type')">
                        Type
                        @if ($sortColumn === 'camera_type')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('location')">
                        Location
                        @if ($sortColumn === 'location')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('status')">
                        Status
                        @if ($sortColumn === 'status')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('encoder_switch_location')">
                        Encoder/Switch Location
                        @if ($sortColumn === 'encoder_switch_location')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('ip_address')">
                        IP Address
                        @if ($sortColumn === 'ip_address')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                <tr>
                    <td>{{ $camera->camera_number }}</td>
                    <td>{{ $camera->camera_name }}</td>
                    <td>{{ $camera->camera_type?->label() }}</td>
                    <td>{{ $camera->location }}</td>
                    <td>
                        @php
                            $statusClasses = match($camera->status) {
                                \App\Enums\CameraStatus::GOOD => 'bg-green-100 text-green-800 border border-green-200',
                                \App\Enums\CameraStatus::NO_VIDEO => 'bg-red-100 text-red-800 border border-red-200',
                                \App\Enums\CameraStatus::BLURRY => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                \App\Enums\CameraStatus::IRIS => 'bg-purple-100 text-purple-800 border border-purple-200',
                                \App\Enums\CameraStatus::ADJUST => 'bg-blue-100 text-blue-800 border border-blue-200',
                                \App\Enums\CameraStatus::CLEAN => 'bg-cyan-100 text-cyan-800 border border-cyan-200',
                                \App\Enums\CameraStatus::PENDING_DIGITAL_UPGRADE => 'bg-orange-100 text-orange-800 border border-orange-200',
                                default => 'bg-gray-100 text-gray-800 border border-gray-200',
                            };
                        @endphp

                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses }}">
                            {{ $camera->status?->label() }}
                        </span>
                    </td>
                    <td>{{ $camera->encoder_switch_location }}</td>
                    <td>{{ $camera->ip_address }}</td>
                    <td><a href="{{route('camera.details', $camera->id)}}">View</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Camera Record Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
