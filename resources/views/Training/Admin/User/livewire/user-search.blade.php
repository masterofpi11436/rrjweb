<div class="max-w-6xl mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">
    <!-- Search Bar & Create Button -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        <input type="text" wire:model.live="search" placeholder="Search users..."
            class="w-full md:w-2/3 p-2 bg-gray-800 text-white broder border-amber-400 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">

        <a href="{{ route('training.admin.user.create') }}"
            class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400
                   transition inline-block text-center">
            + Create User
        </a>
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-700 border-b border-gray-600 text-left">
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('first_name')"
                            class="text-blue-400 hover:text-blue-300 underline">
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('last_name')"
                            class="text-blue-400 hover:text-blue-300 underline">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="#" wire:click.prevent="sortBy('training_role')"
                            class="text-blue-400 hover:text-blue-300 underline">
                            Training Level
                            @if ($sortColumn === 'training_role')
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="p-3">{{ $user->first_name }}</td>
                        <td class="p-3">{{ $user->last_name }}</td>
                        <td class="p-3">{{ $user->training_role->label() }}</td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('training.admin.user.edit', $user->id) }}"
                                class="text-blue-400 border border-blue-500 px-2 py-1 rounded hover:bg-gray-800 hover:border-blue-600">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <a href="#"
                                class="text-red-400 border border-red-500 px-2 py-1 rounded
                                    hover:bg-gray-800 hover:border-red-600 cursor-pointer"
                                onclick="event.preventDefault();
                                    document.getElementById('custom-confirmation-modal-{{ $user->id }}').style.display = 'flex';">
                                Delete
                            </a>

                            <!-- Delete Confirmation Modal -->
                            <div id="custom-confirmation-modal-{{ $user->id }}"
                                class="fixed inset-0 z-50 items-center justify-center bg-black/60"
                                style="display: none;">

                                <div
                                    class="w-full max-w-md rounded-lg border border-red-500 bg-gray-800 p-6 text-white shadow-xl">

                                    <h3 class="mb-2 text-lg font-semibold">
                                        Remove User
                                    </h3>

                                    <p class="mb-6 text-gray-300">
                                        Are you sure you want to remove
                                        {{ $user->first_name }} {{ $user->last_name }}
                                        from the Training application?
                                    </p>

                                    <div class="flex items-center justify-between gap-3">

                                        <!-- Actual DELETE request -->
                                        <form action="{{ route('training.admin.user.destroy', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="!px-4 !py-2 !mb-3
                                                    !bg-red-700
                                                    !rounded-md !border !border-red-400
                                                    hover:!bg-red-600 hover:!border-red-300
                                                    !cursor-pointer !transition !inline-block !text-center">
                                                Yes, Remove
                                            </button>
                                        </form>

                                        <!-- Cancel -->
                                        <a href="#"
                                            class="!px-4 !py-2 !mb-3
                                                !bg-slate-700 !text-gray-100
                                                !rounded-md !border !border-blue-500
                                                hover:!bg-slate-600 hover:!border-blue-400
                                                !cursor-pointer !transition !inline-block !text-center"
                                            onclick="event.preventDefault();
                                                    document.getElementById('custom-confirmation-modal-{{ $user->id }}').style.display = 'none';">
                                            Cancel
                                        </a>

                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-400">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
