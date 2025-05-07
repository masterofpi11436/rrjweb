<div class="max-w-lg mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-gray-300 font-medium">First Name</label>
            <input type="text" id="first_name" wire:model.live="first_name" required
                class="w-full p-2 mt-1 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-white">
            @error('first_name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-gray-300 font-medium">Last Name</label>
            <input type="text" id="last_name" wire:model.live="last_name" required
                class="w-full p-2 mt-1 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-white">
            @error('last_name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-300 font-medium">Email</label>
            <input type="email" id="email" wire:model.live="email" required
                class="w-full p-2 mt-1 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-white">
            @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Warehouse Role -->
        <div>
            <label for="warehouse_role" class="block text-gray-300 font-medium">Warehouse Role</label>
            <select id="warehouse_role" wire:model="warehouse_role"
                class="w-full p-2 mt-1 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-white">
                <option value="Requestor">Requestor</option>
                <option value="Property">Property</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Warehouse Technician">Warehouse Technician</option>
                <option value="Warehouse Supervisor">Warehouse Supervisor</option>
            </select>
            @error('warehouse_role') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center mt-4 gap-2 flex-wrap">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                {{ $userId ? 'Update User' : 'Create User' }}
            </button>

            @if ($userId)
                <button type="button" wire:click="sendResetEmail"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                    Reset Password
                </button>
            @endif

            <a href="{{ route('warehouse.warehouse-supervisor.user.dashboard') }}"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
