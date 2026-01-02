<div>
    <input type="text" wire:model.live="search" placeholder="Search users..." class="form-control">

    <table>
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
                    <a href="#" wire:click.prevent="sortBy('admin')" title="Administreator for ALL Applications. Can log into all applications and perform CRUD operations">
                        Admin
                        @if ($sortColumn === 'admin')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('phone')" title="Admin for the RRJ Phone Directory">
                        Phone
                        @if ($sortColumn === 'phone')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('vfm')" title="Admin for the Vehicle Fleet Maintenance Forms.">
                        VFM
                        @if ($sortColumn === 'vfm')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('vfm_tech')" title="Technician can only create Vehicle Fleet Maintenance Forms">
                        VFM Tech
                        @if ($sortColumn === 'vfm_tech')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('ics')" title="Manages inmates that have access to tablets">
                        ICS
                        @if ($sortColumn === 'ics')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('policy')" title="Can remove/upload policies">
                        Policy
                        @if ($sortColumn === 'policy')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('warehouse_role')" title="Different levels of access for the Warehouse Store">
                        Warehouse
                        @if ($sortColumn === 'warehouse_role')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a href="#" wire:click.prevent="sortBy('policy')" title="Can remove/upload policies">
                        Policy
                        @if ($sortColumn === 'policy')
                            @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                        @endif
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->phone ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->vfm ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->vfm_tech ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->ics ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->policy ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->warehouse_role ?? "No"}}</td>
                    <td>{{ $user->jurisdiction ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}">Edit</a>/
                        <div>
                            <!-- Delete link -->
                            <a href="#" onclick="event.preventDefault(); confirmDelete({{ $user->id }});">Delete</a>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display: none;">
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
            @empty
                <tr>
                    <td colspan="7">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
