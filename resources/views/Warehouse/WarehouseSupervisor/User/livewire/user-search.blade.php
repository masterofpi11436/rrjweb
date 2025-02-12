<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Search Bar & Create Button -->
    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.live="search" placeholder="Search users..."
            class="w-full md:w-2/3 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >

        <a href="{{ route('warehouse.warehouse-supervisor.user.create') }}"
            class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
            + Create User
        </a>
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-200 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-100 border-b text-left">
                    <th>
                        <a href="#" wire:click.prevent="sortBy('first_name')" class="text-blue-600 underline hover:text-blue-800">
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('last_name')" class="text-blue-600 underline hover:text-blue-800">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('warehouse_role')" class="text-blue-600 underline hover:text-blue-800">
                            Warehouse
                            @if ($sortColumn === 'warehouse_role')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $user->first_name }}</td>
                        <td class="p-3">{{ $user->last_name }}</td>
                        <td class="p-3">{{ $user->warehouse_role }}</td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('warehouse.warehouse-supervisor.user.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>

                            <!-- Delete Button -->
                            <a href="#" class="text-red-500 hover:text-red-700"
                                onclick="event.preventDefault(); confirmDelete({{ $user->id }});">
                                Delete
                            </a>

                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $user->id }}" action="{{ route('warehouse.warehouse-supervisor.user.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <!-- Delete Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $user->id }}" class="confirmation-modal" style="display: none;">
                                <div class="modal-content">
                                    <p>Are you sure you want to delete this user?</p>
                                    <button class="btn-confirm" onclick="deleteRecord({{ $user->id }});">Yes, Delete</button>
                                    <button class="btn-cancel" onclick="hideModal({{ $user->id }});">Cancel</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-500">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
