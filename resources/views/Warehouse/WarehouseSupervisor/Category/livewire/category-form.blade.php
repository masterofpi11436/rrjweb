<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- Item Type Name -->
        <div>
            <label for="section" class="block text-gray-700 font-medium">Item Type</label>
            <input type="text" id="section" wire:model.live="section" required
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('section') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                {{ $sectionId ? 'Update Section' : 'Create Section' }}
            </button>

            <!-- Cancel Button -->
            <a href="{{ route('warehouse.warehouse-supervisor.section.dashboard') }}"
                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
