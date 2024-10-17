<div>
    <input type="text" wire:model.live="search" placeholder="Search users..." />

    @if ($suggestions->isNotEmpty())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('first_name')">
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('last_name')">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('email')">
                            Email
                            @if ($sortColumn === 'email')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('applications')">
                            Application(s)
                            @if ($sortColumn === 'applications')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('roles')">
                            Role
                            @if ($sortColumn === 'roles')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->applications as $application)
                                <div>{{ $application->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            {{ $user->roles->pluck('name')->join(', ') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $user->id }});">Delete</a>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('phone.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $user->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this extension?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $user->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $user->id }});">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No users found.</p>
    @endif
</div>
