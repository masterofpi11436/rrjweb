<div class="max-w-3xl mx-auto p-6 text-gray-900 dark:text-gray-100 rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Time Log Form</h2>

    <form wire:submit.prevent="submitForm" class="space-y-6">
        <!-- Jurisdiction -->
        <div>
            <label for="jurisdiction_id" class="block text-sm font-medium">Jurisdiction</label>
            <select wire:model="jurisdiction_id" id="jurisdiction_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
                <option value="">-- Select Jurisdiction --</option>
                @foreach ($jurisdictions as $j)
                    <option value="{{ $j->id }}">{{ $j->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Date -->
        <div>
            <label for="date_of_visit" class="block text-sm font-medium">Date of Visit</label>
            <input type="date" id="date_of_visit" wire:model="date_of_visit" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
        </div>

        <!-- Time Pairs -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="arrival_time" class="block text-sm font-medium">Arrival Time</label>
                <input type="time" id="arrival_time" wire:model="arrival_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
            <div>
                <label for="departure_time" class="block text-sm font-medium">Departure Time</label>
                <input type="time" id="departure_time" wire:model="departure_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
            <div>
                <label for="magistrate_start" class="block text-sm font-medium">Magistrate Start</label>
                <input type="time" id="magistrate_start" wire:model="magistrate_start" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
            <div>
                <label for="magistrate_end" class="block text-sm font-medium">Magistrate End</label>
                <input type="time" id="magistrate_end" wire:model="magistrate_end" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
            <div>
                <label for="nurse_start" class="block text-sm font-medium">Nurse Start</label>
                <input type="time" id="nurse_start" wire:model="nurse_start" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
            <div>
                <label for="nurse_end" class="block text-sm font-medium">Nurse End</label>
                <input type="time" id="nurse_end" wire:model="nurse_end" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800">
            </div>
        </div>

        <!-- Checkbox -->
        <div class="flex items-center">
            <input id="did_not_get_committed" type="checkbox" wire:model="did_not_get_committed" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="did_not_get_committed" class="ml-2 block text-sm font-medium">Rejected</label>
        </div>

        <!-- Note -->
        <div>
            <label for="note" class="block text-sm font-medium">Note</label>
            <textarea wire:model="note" id="note" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800"></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            {{ $logId ? 'Update' : 'Create' }} Time Log
        </button>
    </form>
</div>
