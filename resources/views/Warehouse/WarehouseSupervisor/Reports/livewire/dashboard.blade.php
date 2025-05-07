<div class="max-w-6xl mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">

    <!-- Search Bar & Create Button -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        <input type="text" wire:model.live="search" placeholder="Search recipients..."
            class="w-full md:w-2/3 p-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">

        <a href="{{ route('warehouse.warehouse-supervisor.reports.monthly.create') }}"
            class="px-4 py-2 bg-blue-700 text-white border border-blue-600 rounded-md hover:bg-blue-800 hover:border-blue-700">
            + Add Recipient
        </a>
    </div>

    <!-- Recipient Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-700 border-b border-gray-600 text-left">
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('first_name')" class="text-blue-400 hover:text-blue-300 underline">
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('last_name')" class="text-blue-400 hover:text-blue-300 underline">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('email')" class="text-blue-400 hover:text-blue-300 underline">
                            Email
                            @if ($sortColumn === 'email')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suggestions as $recipient)
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="p-3">{{ $recipient->first_name }}</td>
                        <td class="p-3">{{ $recipient->last_name }}</td>
                        <td class="p-3">{{ $recipient->email }}</td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('warehouse.warehouse-supervisor.reports.monthly.edit', $recipient->id) }}"
                               class="text-blue-400 border border-blue-500 px-2 py-1 rounded hover:bg-gray-800 hover:border-blue-600">
                                Edit
                            </a>

                            <a href="#"
                               class="text-red-400 border border-red-500 px-2 py-1 rounded hover:bg-gray-800 hover:border-red-600"
                               onclick="event.preventDefault(); confirmDelete({{ $recipient->id }});">
                                Delete
                            </a>

                            <form id="delete-form-{{ $recipient->id }}"
                                  action="{{ route('warehouse.warehouse-supervisor.reports.monthly.destroy', $recipient->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <!-- Delete Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $recipient->id }}" class="confirmation-modal hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
                                <div class="modal-content bg-gray-800 text-white p-4 rounded border border-red-500">
                                    <p class="mb-4">Are you sure you want to delete this recipient?</p>
                                    <button class="px-3 py-1 bg-red-600 text-white rounded border border-red-700 hover:bg-red-700"
                                            onclick="deleteRecord({{ $recipient->id }});">
                                        Yes, Delete
                                    </button>
                                    <button class="ml-2 px-3 py-1 bg-gray-700 text-white rounded border border-gray-600 hover:bg-gray-600"
                                            onclick="hideModal({{ $recipient->id }});">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-400">No recipients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
