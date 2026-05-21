<div>
    <input
        type="text"
        wire:model.live="search"
        placeholder="Search camera..."
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
                <th>Encoder/Switch Location</th>
                <th>IP Address</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                <tr>
                    <td><a href="{{route('camera.edit', $camera->id)}}">{{ $camera->camera_number }}</a></td>
                    <td>{{ $camera->camera_name }}</td>
                    <td>{{ ucfirst($camera->camera_type?->value) ?? ucfirst($camera->camera_type) }}</td>
                    <td>{{ $camera->location }}</td>
                    <td>{{ $camera->status?->value ?? $camera->status }}</td>
                    <td>{{ $camera->encoder_switch_location }}</td>
                    <td>{{ $camera->ip_address }}</td>
                    <td>
                        <div>
                            <a href="#" onclick="event.preventDefault(); confirmDelete({{ $camera->id }});">Delete</a>
                            <form id="delete-form-{{ $camera->id }}" action="{{ route('camera.destroy', $camera->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <!-- Custom Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $camera->id }}" class="confirmation-modal" style="display: none;">
                                <div class="modal-content">
                                    <p>Are you sure you want to delete this camera from the schedule?</p>
                                    <button class="btn-confirm" onclick="deleteRecord({{ $camera->id }});">Yes, Delete</button>
                                    <button class="btn-cancel" onclick="hideModal({{ $camera->id }});">Cancel</button>
                                </div>
                            </div>
                        </div>
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
