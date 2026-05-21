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
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suggestions as $camera)
                <tr>
                    <td><a href="{{route('camera.edit', $camera->id)}}">{{ $camera->camera_number }}</a></td>
                    <td>{{ $camera->camera_name }}</td>
                    <td>{{ $camera->camera_type?->label() }}</td>
                    <td>{{ $camera->location }}</td>
                    <td>{{ $camera->status?->label() }}</td>
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
