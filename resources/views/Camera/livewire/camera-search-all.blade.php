<div>
    <input type="text" wire:model.live="search" placeholder="Search camera...">

    <table>
        <thead>
            <tr>
                <th>
                    <a href="#" wire:click.prevent="sortBy('camera_number')">
                        Camera#
                        @if ($sortColumn === 'camera_number')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('camera_name')">
                        Name
                        @if ($sortColumn === 'camera_name')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('camera_type')">
                        Type
                        @if ($sortColumn === 'camera_type')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                    </a>
                </th>

                <th>
                    <a href="#" wire:click.prevent="sortBy('location')">
                        Location
                        @if ($sortColumn === 'location')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('status')">
                        Status
                        @if ($sortColumn === 'status')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                    </a>
                </th>
                <th>Change Status</th>
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
                            $statusClasses = match ($camera->status) {
                                \App\Enums\CameraStatus::GOOD => 'bg-green-100 text-green-800 border border-green-200',
                                \App\Enums\CameraStatus::NO_VIDEO => 'bg-red-100 text-red-800 border border-red-200',
                                \App\Enums\CameraStatus::BLURRY
                                    => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                \App\Enums\CameraStatus::IRIS
                                    => 'bg-purple-100 text-purple-800 border border-purple-200',
                                \App\Enums\CameraStatus::ADJUST => 'bg-blue-100 text-blue-800 border border-blue-200',
                                \App\Enums\CameraStatus::CLEAN => 'bg-cyan-100 text-cyan-800 border border-cyan-200',
                                \App\Enums\CameraStatus::PENDING_DIGITAL_UPGRADE
                                    => 'bg-orange-100 text-orange-800 border border-orange-200',
                                default => 'bg-gray-100 text-gray-800 border border-gray-200',
                            };
                        @endphp

                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses }}">
                            {{ $camera->status?->label() }}
                        </span>
                    </td>
                    <td>
                        <select wire:change="changeStatus({{ $camera->id }}, $event.target.value)"
                            class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none">

                            @foreach (\App\Enums\CameraStatus::cases() as $type)
                                <option value="{{ $type->value }}" @selected($camera->status === $type || $camera->status?->value === $type->value)>
                                    {{ $type->label() }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Camera Record Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
