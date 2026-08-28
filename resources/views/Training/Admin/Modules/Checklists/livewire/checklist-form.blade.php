<div class="space-y-6">

    <form wire:submit="save" class="space-y-6">

        {{-- Checklist Title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Checklist Title
            </label>

            <input id="title" type="text" wire:model="title" placeholder="Enter the checklist title"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white
                       placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-500/30">

            @error('title')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Checklist Description --}}
        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                Description
            </label>

            <textarea id="description" wire:model="description" rows="4" placeholder="Enter an optional checklist description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white
                       placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Checklist Groups --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

            <div
                class="flex flex-col gap-3 border-b border-gray-700 px-5 py-4
                       sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-white">
                        Checklist Groups
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Organize checklist items into related groups.
                    </p>
                </div>

                <button type="button" wire:click="addGroup"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600
                           px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                    Add Group
                </button>
            </div>


            <div class="space-y-6 p-5">

                @error('groups')
                    <div
                        class="rounded-lg border border-red-700 bg-red-950/40
                               px-4 py-3 text-sm text-red-300">
                        {{ $message }}
                    </div>
                @enderror


                @foreach ($groups as $groupIndex => $group)
                    <div wire:key="checklist-group-{{ $group['id'] ?? 'new-' . $groupIndex }}"
                        class="overflow-hidden rounded-xl border border-gray-700 bg-gray-800">

                        {{-- Group Header --}}
                        <div
                            class="flex flex-col gap-3 border-b border-gray-700 px-4 py-3
                                   lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h3 class="font-semibold text-white">
                                    Group {{ $groupIndex + 1 }}
                                </h3>

                                @if (!empty($group['title']))
                                    <p class="mt-1 text-sm text-gray-400">
                                        {{ $group['title'] }}
                                    </p>
                                @endif
                            </div>


                            <div class="flex flex-wrap gap-2">

                                <button type="button" wire:click="moveGroupUp({{ $groupIndex }})"
                                    @disabled($groupIndex === 0)
                                    class="inline-flex items-center justify-center rounded-lg border
                                           border-gray-600 px-3 py-2 text-xs font-medium text-gray-300
                                           hover:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-40">
                                    Move Up
                                </button>

                                <button type="button" wire:click="moveGroupDown({{ $groupIndex }})"
                                    @disabled($groupIndex === count($groups) - 1)
                                    class="inline-flex items-center justify-center rounded-lg border
                                           border-gray-600 px-3 py-2 text-xs font-medium text-gray-300
                                           hover:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-40">
                                    Move Down
                                </button>

                                <button type="button" wire:click="insertGroup({{ $groupIndex }})"
                                    class="inline-flex items-center justify-center rounded-lg border
                                           border-blue-700 px-3 py-2 text-xs font-medium text-blue-300
                                           hover:bg-blue-950/50">
                                    Insert Below
                                </button>

                                <button type="button" wire:click="removeGroup({{ $groupIndex }})"
                                    wire:confirm="Are you sure you want to remove this checklist group and all of its items?"
                                    class="inline-flex items-center justify-center rounded-lg border
                                           border-red-700 px-3 py-2 text-xs font-medium text-red-400
                                           hover:bg-red-950/50">
                                    Remove Group
                                </button>

                            </div>
                        </div>


                        {{-- Group Information --}}
                        <div class="space-y-4 border-b border-gray-700 p-4">

                            <div>
                                <label for="group-title-{{ $groupIndex }}"
                                    class="mb-2 block text-sm font-medium text-gray-200">
                                    Group Title
                                </label>

                                <input id="group-title-{{ $groupIndex }}" type="text"
                                    wire:model="groups.{{ $groupIndex }}.title"
                                    placeholder="Example: Inmate Grievance"
                                    class="w-full rounded-lg border border-gray-600 bg-gray-900
                                           px-4 py-3 text-white placeholder:text-gray-500
                                           focus:border-blue-500 focus:outline-none
                                           focus:ring-2 focus:ring-blue-500/30">

                                @error("groups.$groupIndex.title")
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            <div>
                                <label for="group-description-{{ $groupIndex }}"
                                    class="mb-2 block text-sm font-medium text-gray-200">
                                    Group Description
                                </label>

                                <textarea id="group-description-{{ $groupIndex }}" wire:model="groups.{{ $groupIndex }}.description"
                                    rows="3" placeholder="Optional description or instructions for this group"
                                    class="w-full rounded-lg border border-gray-600 bg-gray-900
                                           px-4 py-3 text-white placeholder:text-gray-500
                                           focus:border-blue-500 focus:outline-none
                                           focus:ring-2 focus:ring-blue-500/30"></textarea>

                                @error("groups.$groupIndex.description")
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>


                        {{-- Group Items --}}
                        <div class="p-4">

                            <div class="mb-4 flex items-center justify-between gap-4">

                                <div>
                                    <h4 class="font-medium text-gray-200">
                                        Items
                                    </h4>

                                    <p class="mt-1 text-sm text-gray-400">
                                        Add the tasks or topics that belong to this group.
                                    </p>
                                </div>

                                <button type="button" wire:click="addItem({{ $groupIndex }})"
                                    class="inline-flex items-center justify-center rounded-lg bg-blue-700
                                           px-3 py-2 text-sm font-semibold text-white hover:bg-blue-600">
                                    Add Item
                                </button>
                            </div>


                            @error("groups.$groupIndex.items")
                                <div
                                    class="mb-4 rounded-lg border border-red-700 bg-red-950/40
                                           px-4 py-3 text-sm text-red-300">
                                    {{ $message }}
                                </div>
                            @enderror


                            <div class="space-y-4">

                                @foreach ($group['items'] as $itemIndex => $item)
                                    <div wire:key="checklist-item-{{ $groupIndex }}-{{ $item['id'] ?? 'new-' . $itemIndex }}"
                                        class="rounded-xl border border-gray-700 bg-gray-900">

                                        {{-- Item Header --}}
                                        <div
                                            class="flex flex-col gap-3 border-b border-gray-700 px-4 py-3
                                                   lg:flex-row lg:items-center lg:justify-between">
                                            <h5 class="font-medium text-white">
                                                Item {{ $itemIndex + 1 }}
                                            </h5>


                                            <div class="flex flex-wrap gap-2">

                                                <button type="button"
                                                    wire:click="moveItemUp({{ $groupIndex }}, {{ $itemIndex }})"
                                                    @disabled($itemIndex === 0)
                                                    class="inline-flex items-center justify-center rounded-lg border
                                                           border-gray-600 px-3 py-2 text-xs font-medium text-gray-300
                                                           hover:bg-gray-700 disabled:cursor-not-allowed
                                                           disabled:opacity-40">
                                                    Move Up
                                                </button>

                                                <button type="button"
                                                    wire:click="moveItemDown({{ $groupIndex }}, {{ $itemIndex }})"
                                                    @disabled($itemIndex === count($group['items']) - 1)
                                                    class="inline-flex items-center justify-center rounded-lg border
                                                           border-gray-600 px-3 py-2 text-xs font-medium text-gray-300
                                                           hover:bg-gray-700 disabled:cursor-not-allowed
                                                           disabled:opacity-40">
                                                    Move Down
                                                </button>

                                                <button type="button"
                                                    wire:click="insertItem({{ $groupIndex }}, {{ $itemIndex }})"
                                                    class="inline-flex items-center justify-center rounded-lg border
                                                           border-blue-700 px-3 py-2 text-xs font-medium text-blue-300
                                                           hover:bg-blue-950/50">
                                                    Insert Below
                                                </button>

                                                <button type="button"
                                                    wire:click="removeItem({{ $groupIndex }}, {{ $itemIndex }})"
                                                    wire:confirm="Are you sure you want to remove this checklist item?"
                                                    class="inline-flex items-center justify-center rounded-lg border
                                                           border-red-700 px-3 py-2 text-xs font-medium text-red-400
                                                           hover:bg-red-950/50">
                                                    Remove
                                                </button>

                                            </div>
                                        </div>


                                        {{-- Item Fields --}}
                                        <div class="space-y-4 p-4">

                                            <div>
                                                <label for="item-{{ $groupIndex }}-{{ $itemIndex }}"
                                                    class="mb-2 block text-sm font-medium text-gray-200">
                                                    Item
                                                </label>

                                                <textarea id="item-{{ $groupIndex }}-{{ $itemIndex }}"
                                                    wire:model="groups.{{ $groupIndex }}.items.{{ $itemIndex }}.item" rows="3"
                                                    placeholder="Enter the checklist item"
                                                    class="w-full rounded-lg border border-gray-600 bg-gray-950
                                                           px-4 py-3 text-white placeholder:text-gray-500
                                                           focus:border-blue-500 focus:outline-none
                                                           focus:ring-2 focus:ring-blue-500/30"></textarea>

                                                @error("groups.$groupIndex.items.$itemIndex.item")
                                                    <p class="mt-2 text-sm text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>


                                            <div>
                                                <label for="item-description-{{ $groupIndex }}-{{ $itemIndex }}"
                                                    class="mb-2 block text-sm font-medium text-gray-200">
                                                    Additional Instructions
                                                </label>

                                                <textarea id="item-description-{{ $groupIndex }}-{{ $itemIndex }}"
                                                    wire:model="groups.{{ $groupIndex }}.items.{{ $itemIndex }}.description" rows="3"
                                                    placeholder="Enter optional instructions or details"
                                                    class="w-full rounded-lg border border-gray-600 bg-gray-950
                                                           px-4 py-3 text-white placeholder:text-gray-500
                                                           focus:border-blue-500 focus:outline-none
                                                           focus:ring-2 focus:ring-blue-500/30"></textarea>

                                                @error("groups.$groupIndex.items.$itemIndex.description")
                                                    <p class="mt-2 text-sm text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>


        {{-- Actions --}}
        <div
            class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6
                   sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600
                       px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600
                       px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500
                       disabled:cursor-not-allowed disabled:opacity-50">
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
