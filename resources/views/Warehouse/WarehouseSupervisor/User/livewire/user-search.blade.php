<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Search Bar & Create Button -->
    <div class="flex justify-between items-center mb-4">
        <!-- Search Input -->
        <input type="text" wire:model.live="search" placeholder="Search users..."
            class="w-full md:w-2/3 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >

        <!-- Create User Button -->
        <a href="{{ route('admin.create') }}"
            class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
            + Create User
        </a>
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-200 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-100 border-b text-left">
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('first_name')" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600">
                            <span>First Name</span>
                            @if ($sortColumn === 'first_name')
                                <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('last_name')" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600">
                            <span>Last Name</span>
                            @if ($sortColumn === 'last_name')
                                <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('warehouse_role')" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600">
                            <span>Warehouse Role</span>
                            @if ($sortColumn === 'warehouse_role')
                                <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
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
                            <a href="{{ route('admin.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <a href="#" class="text-red-500 hover:text-red-700"
                                wire:click="deleteUser({{ $user->id }})"
                                onclick="event.preventDefault(); confirmDelete({{ $user->id }});">
                                Delete
                            </a>

                            <!-- Delete Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $user->id }}" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <p class="text-lg font-semibold mb-4">Are you sure you want to delete this user?</p>
                                    <div class="flex justify-end space-x-4">
                                        <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700"
                                            wire:click="deleteUser({{ $user->id }})">
                                            Yes, Delete
                                        </button>
                                        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                                            onclick="hideModal({{ $user->id }});">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    function confirmDelete(userId) {
        document.getElementById(`custom-confirmation-modal-${userId}`).classList.remove('hidden');
    }

    function hideModal(userId) {
        document.getElementById(`custom-confirmation-modal-${userId}`).classList.add('hidden');
    }
</script>
