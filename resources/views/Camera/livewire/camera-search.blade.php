<div>
    <input
        type="text"
        wire:model.live="search"
        placeholder="Search camera number..."
    >

    <table>
        <thead>
            <tr>
                <th wire:click="sortBy('camera_number')" style="cursor:pointer;">
                    Camera #
                </th>
                <th wire:click="sortBy('camera_name')" style="cursor:pointer;">
                    Name
                </th>
                <th wire:click="sortBy('camera_type')" style="cursor:pointer;">
                    Type
                </th>
                <th wire:click="sortBy('location')" style="cursor:pointer;">
                    Location
                </th>
                <th wire:click="sortBy('status')" style="cursor:pointer;">
                    Status
                </th>
                <th>Encoder / Switch</th>
                <th>IP Address</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                <tr>
                    <td><a href="{{route('camera.edit', $camera->id)}}">{{ $camera->camera_number }}</a></td>
                    <td>{{ $camera->camera_name }}</td>
                    <td>{{ $camera->camera_type?->value ?? $camera->camera_type }}</td>
                    <td>{{ $camera->location }}</td>
                    <td>{{ $camera->status?->value ?? $camera->status }}</td>
                    <td>{{ $camera->encoder_switch_location }}</td>
                    <td>{{ $camera->ip_address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No cameras found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
