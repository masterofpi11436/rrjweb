<div class="space-y-6">
    <form wire:submit="save" class="space-y-6">

        {{-- Checklist title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Checklist Title
            </label>

            <input id="title" type="text" wire:model="title" placeholder="Enter the checklist title"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

            @error('title')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                Description
            </label>

            <textarea id="description" wire:model="description" rows="4" placeholder="Enter an optional checklist description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Checklist items --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
            <div
                class="flex flex-col gap-3 border-b border-gray-700 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-white">
                        Checklist Items
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Add the tasks the trainee must complete.
                    </p>
                </div>

                <button type="button" wire:click="addItem"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                    Add Item
                </button>
            </div>

            <div class="space-y-5 p-5">
                @error('items')
                    <div class="rounded-lg border border-red-700 bg-red-950/40 px-4 py-3 text-sm text-red-300">
                        {{ $message }}
                    </div>
                @enderror

                @foreach ($items as $index => $item)
                    <div wire:key="checklist-item-{{ $item['id'] ?? 'new-' . $index }}"
                        class="overflow-hidden rounded-xl border border-gray-700 bg-gray-800">
                        <div
                            class="flex flex-col gap-3 border-b border-gray-700 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                            <h3 class="font-medium text-white">
                                Item {{ $index + 1 }}
                            </h3>

                            <div class="flex flex-wrap gap-2">
                                <button type="button" wire:click="moveItemUp({{ $index }})"
                                    @disabled($index === 0)
                                    class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-3 py-2 text-xs font-medium text-gray-300 hover:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-40">
                                    Move Up
                                </button>

                                <button type="button" wire:click="moveItemDown({{ $index }})"
                                    @disabled($index === count($items) - 1)
                                    class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-3 py-2 text-xs font-medium text-gray-300 hover:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-40">
                                    Move Down
                                </button>

                                <button type="button" wire:click="insertItem({{ $index }})"
                                    class="inline-flex items-center justify-center rounded-lg border border-blue-700 px-3 py-2 text-xs font-medium text-blue-300 hover:bg-blue-950/50">
                                    Insert Below
                                </button>

                                <button type="button" wire:click="removeItem({{ $index }})"
                                    wire:confirm="Are you sure you want to remove this checklist item?"
                                    class="inline-flex items-center justify-center rounded-lg border border-red-700 px-3 py-2 text-xs font-medium text-red-400 hover:bg-red-950/50">
                                    Remove
                                </button>
                            </div>
                        </div>

                        <div class="space-y-4 p-4">
                            {{-- Item text --}}
                            <div>
                                <label for="item-{{ $index }}"
                                    class="mb-2 block text-sm font-medium text-gray-200">
                                    Item
                                </label>

                                <textarea id="item-{{ $index }}" wire:model="items.{{ $index }}.item" rows="3"
                                    placeholder="Enter the checklist item"
                                    class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

                                @error("items.$index.item")
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Item description --}}
                            <div>
                                <label for="item-description-{{ $index }}"
                                    class="mb-2 block text-sm font-medium text-gray-200">
                                    Additional Instructions
                                </label>

                                <textarea id="item-description-{{ $index }}" wire:model="items.{{ $index }}.description" rows="3"
                                    placeholder="Enter optional instructions or details"
                                    class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

                                @error("items.$index.description")
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">
            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500 disabled:cursor-not-allowed disabled:opacity-50">
                <span wire:loading.remove wire:target="save">
                    {{ $checklistId ? 'Save Changes' : 'Create Checklist' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>
