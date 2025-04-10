<div class="max-w-lg mx-auto p-6 bg-gray-900 text-white shadow-md rounded-lg border border-gray-700">
    <form wire:submit.prevent="submitForm" class="space-y-4">

        <!-- Section Name -->
        <div>
            <label for="section" class="block text-gray-200 font-medium">Section</label>
            <input type="text" id="section" wire:model.live="section" required
                class="w-full p-2 mt-1 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-400">
            @error('section') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex justify-between items-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-700 text-white border border-blue-600 rounded hover:bg-blue-800 hover:border-blue-700">
                {{ $sectionId ? 'Update Section' : 'Create Section' }}
            </button>

            <a href="{{ route('warehouse.warehouse-supervisor.section.dashboard') }}"
                class="px-4 py-2 bg-red-700 text-white border border-red-600 rounded hover:bg-red-800 hover:border-red-700 inline-block text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
