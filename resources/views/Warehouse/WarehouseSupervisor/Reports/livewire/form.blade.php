<div class="max-w-lg mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-gray-200 font-medium">First Name</label>
            <input type="text" id="first_name" wire:model.live="first_name" required
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">
            @error('first_name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-gray-200 font-medium">Last Name</label>
            <input type="text" id="last_name" wire:model.live="last_name" required
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">
            @error('last_name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-200 font-medium">Email</label>
            <input type="text" id="email" wire:model.live="email" required
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">
            @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex justify-between items-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-700 text-white border border-blue-600 rounded hover:bg-blue-800 hover:border-blue-700">
                {{ $recipientId ? 'Update Recipient' : 'Create Recipient' }}
            </button>

            <a href="{{ route('warehouse.warehouse-supervisor.reports.monthly.dashboard') }}"
                class="px-4 py-2 bg-red-700 text-white border border-red-600 rounded hover:bg-red-800 hover:border-red-700 inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
