<div class="space-y-5">

    @if ($flashMessage)
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 50);

        setTimeout(() => {
            show = false;

            setTimeout(() => {
                $wire.set('flashMessage', null);
            }, 300);
        }, 2000);" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-5 right-5 z-50 w-full max-w-md
               rounded-lg border border-green-600
               bg-gray-900 px-5 py-4 text-sm text-gray-200 shadow-lg">
            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-green-500/10 text-green-400">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold text-green-400">
                            Success
                        </p>

                        <p class="mt-0.5 text-gray-300">
                            {{ $flashMessage }}
                        </p>
                    </div>

                </div>

                <button type="button" @click="show = false"
                    class="rounded-md px-2 py-1 text-xl text-gray-400 border
                       hover:bg-gray-800 hover:text-white transition">
                    &times;
                </button>

            </div>
        </div>
    @endif

    <form wire:submit="save" class="space-y-5">

        {{-- Checklist Information --}}
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

            {{-- Title --}}
            <div class="lg:col-span-4">
                <label for="title" class="mb-1.5 block text-sm font-medium text-gray-200">
                    Checklist Title
                </label>

                <input id="title" type="text" wire:model="title" placeholder="Enter the checklist title"
                    class="w-full rounded-lg border border-gray-600 bg-gray-800
                           px-3 py-2 text-white placeholder:text-gray-500
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-500/30">

                @error('title')
                    <p class="mt-1 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        {{-- Checklist Description --}}
        <div>
            <label for="description" class="mb-1.5 block text-sm font-medium text-gray-200">
                Description
            </label>

            <textarea id="description" wire:model="description" rows="2" placeholder="Optional checklist description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800
               px-3 py-2 text-white placeholder:text-gray-500
               focus:border-blue-500 focus:outline-none
               focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-1 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Module Categories --}}
        <div>
            <div class="mb-2 flex items-center justify-between">

                <div>
                    <label class="block text-sm font-medium text-gray-200">
                        Categories
                    </label>

                    <p class="mt-1 text-xs text-gray-500">
                        Select the categories this module belongs to.
                    </p>
                </div>

                <a href="{{ route('training.admin.modules.categories.index') }}"
                    class="px-3 py-1.5
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400
                   cursor-pointer transition inline-block text-center text-xs">
                    Manage Categories
                </a>

            </div>

            @if ($categories->isNotEmpty())

                <div class="flex flex-wrap gap-2">

                    @foreach ($categories as $category)
                        <label wire:key="category-{{ $category->id }}"
                            class="flex cursor-pointer items-center gap-2
                           rounded-md border border-gray-700
                           bg-gray-800 px-3 py-2
                           text-sm text-gray-300
                           hover:border-gray-600 hover:bg-gray-700/70">

                            <input type="checkbox" value="{{ $category->id }}" wire:model="selectedCategories"
                                class="h-4 w-4 cursor-pointer rounded
                               border-gray-600 bg-gray-900
                               text-blue-600 focus:ring-blue-500">

                            <span>
                                {{ $category->name }}
                            </span>

                        </label>
                    @endforeach

                </div>
            @else
                <div class="rounded-lg border border-yellow-700
                    bg-yellow-950/30 px-4 py-3">

                    <p class="text-sm text-yellow-300">
                        No module categories have been created.
                    </p>

                </div>

            @endif

            @error('selectedCategories.*')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Groups Error --}}
        @error('groups')
            <div
                class="rounded-lg border border-red-700 bg-red-950/40
                        px-4 py-3 text-sm text-red-300">
                {{ $message }}
            </div>
        @enderror

        {{-- Checklist Groups --}}
        <div class="space-y-4">

            @foreach ($groups as $groupIndex => $group)
                <section wire:key="checklist-group-{{ $group['id'] ?? 'new-' . $groupIndex }}"
                    class="overflow-hidden rounded-lg border border-gray-700 bg-gray-900">

                    {{-- Group Header --}}
                    <div
                        class="flex flex-wrap items-center justify-between gap-3
                                border-b border-gray-700 bg-gray-800/70
                                px-4 py-2.5">

                        <div class="flex items-center gap-3">
                            <span
                                class="flex h-7 w-7 items-center justify-center
                                         rounded-md bg-gray-700 text-xs
                                         font-bold text-gray-300">
                                {{ $groupIndex + 1 }}
                            </span>

                            <div>
                                <h3 class="text-sm font-semibold text-white">
                                    {{ !empty($group['title']) ? $group['title'] : 'Untitled Group' }}
                                </h3>

                                <p class="text-xs text-gray-500">
                                    {{ count($group['items']) }}
                                    {{ count($group['items']) === 1 ? 'item' : 'items' }}
                                </p>
                            </div>
                        </div>

                        {{-- Group Controls --}}
                        <div class="flex items-center gap-1">

                            <a wire:click="moveGroupUp({{ $groupIndex }})" @disabled($groupIndex === 0)
                                title="Move group up"
                                class="px-4 py-2
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-blue-500
                                    hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                                    transition inline-block text-center">
                                ↑
                            </a>

                            <a wire:click="moveGroupDown({{ $groupIndex }})" @disabled($groupIndex === count($groups) - 1)
                                title="Move group down"
                                class="px-4 py-2
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-blue-500
                                    hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                                    transition inline-block text-center">
                                ↓
                            </a>

                            <a wire:click="insertGroup({{ $groupIndex }})" title="Insert group below"
                                class="px-4 py-2
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-green-500
                                    hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                    transition inline-block text-center">
                                + Group
                            </a>

                            <a wire:click="removeGroup({{ $groupIndex }})"
                                wire:confirm="Are you sure you want to remove this checklist group and all of its items?"
                                title="Remove group"
                                class="px-4 py-2
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-red-500
                                    hover:bg-slate-600 hover:border-red-400 cursor-pointer
                                    transition inline-block text-center">
                                ×
                            </a>
                        </div>
                    </div>


                    {{-- Group Information --}}
                    <div
                        class="grid grid-cols-1 gap-3 border-b border-gray-700
                                px-4 py-3 lg:grid-cols-2">

                        {{-- Group Title --}}
                        <div>
                            <label for="group-title-{{ $groupIndex }}"
                                class="mb-1 block text-xs font-medium
                                       uppercase tracking-wide text-gray-400">
                                Group Title
                            </label>

                            <input id="group-title-{{ $groupIndex }}" type="text"
                                wire:model="groups.{{ $groupIndex }}.title" placeholder="Example: Inmate Grievance"
                                class="w-full rounded-md border border-gray-600
                                       bg-gray-950 px-3 py-2 text-sm text-white
                                       placeholder:text-gray-600
                                       focus:border-blue-500 focus:outline-none">

                            @error("groups.$groupIndex.title")
                                <p class="mt-1 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Group Description --}}
                        <div>
                            <label for="group-description-{{ $groupIndex }}"
                                class="mb-1 block text-xs font-medium
                                       uppercase tracking-wide text-gray-400">
                                Description
                            </label>

                            <input id="group-description-{{ $groupIndex }}" type="text"
                                wire:model="groups.{{ $groupIndex }}.description"
                                placeholder="Optional group instructions"
                                class="w-full rounded-md border border-gray-600
                                       bg-gray-950 px-3 py-2 text-sm text-white
                                       placeholder:text-gray-600
                                       focus:border-blue-500 focus:outline-none">

                            @error("groups.$groupIndex.description")
                                <p class="mt-1 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Items Header --}}
                    <div
                        class="flex items-center justify-between
                                border-b border-gray-800 px-4 py-2">

                        <span
                            class="text-xs font-semibold uppercase
                                     tracking-wide text-gray-400">
                            Checklist Items
                        </span>

                        <a wire:click="addItem({{ $groupIndex }})"
                            class="px-4 py-2
                                bg-slate-700 text-gray-100
                                rounded-md border border-green-500
                                hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                transition inline-block text-center">
                            + Add Item
                        </a>
                    </div>

                    @error("groups.$groupIndex.items")
                        <div
                            class="m-3 rounded-md border border-red-700
                                    bg-red-950/40 px-3 py-2
                                    text-sm text-red-300">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Compact Item List --}}
                    <div class="divide-y divide-gray-800">

                        @foreach ($group['items'] as $itemIndex => $item)
                            <div wire:key="checklist-item-{{ $groupIndex }}-{{ $item['id'] ?? 'new-' . $itemIndex }}"
                                class="group px-3 py-2.5 hover:bg-gray-800/30">

                                <div class="flex items-start gap-2">

                                    {{-- Item Number --}}
                                    <div
                                        class="flex h-8 w-8 shrink-0 items-center
                                                justify-center rounded-md bg-gray-800
                                                text-xs font-semibold text-gray-400">
                                        {{ $itemIndex + 1 }}
                                    </div>

                                    {{-- Item Fields --}}
                                    <div class="min-w-0 flex-1">

                                        <textarea id="item-{{ $groupIndex }}-{{ $itemIndex }}"
                                            wire:model="groups.{{ $groupIndex }}.items.{{ $itemIndex }}.item" rows="2"
                                            placeholder="Checklist item"
                                            class="w-full resize-y rounded-md border
                                                   border-gray-700 bg-gray-950
                                                   px-3 py-2 text-sm text-white
                                                   placeholder:text-gray-600
                                                   focus:border-blue-500
                                                   focus:outline-none"></textarea>

                                        @error("groups.$groupIndex.items.$itemIndex.item")
                                            <p class="mt-1 text-xs text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                        {{-- Optional Instructions --}}
                                        <input id="item-description-{{ $groupIndex }}-{{ $itemIndex }}"
                                            type="text"
                                            wire:model="groups.{{ $groupIndex }}.items.{{ $itemIndex }}.description"
                                            placeholder="Optional instructions"
                                            class="mt-1.5 w-full rounded-md border
                                                   border-gray-800 bg-gray-900
                                                   px-3 py-1.5 text-xs text-gray-300
                                                   placeholder:text-gray-600
                                                   focus:border-blue-500
                                                   focus:outline-none">

                                        @error("groups.$groupIndex.items.$itemIndex.description")
                                            <p class="mt-1 text-xs text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>


                                    {{-- Item Controls --}}
                                    <div class="flex shrink-0 flex-col gap-1">

                                        <div class="flex gap-1">

                                            <a wire:click="moveItemUp({{ $groupIndex }}, {{ $itemIndex }})"
                                                @disabled($itemIndex === 0) title="Move item up"
                                                class="px-4 py-2
                                                    bg-slate-700 text-gray-100
                                                    rounded-md border border-blue-500
                                                    hover:bg-slate-600 hover:border-blue-400
                                                    cursor-pointer transition inline-block text-center
                                                    disabled:cursor-not-allowed disabled:opacity-25">
                                                ↑
                                            </a>

                                            <a wire:click="moveItemDown({{ $groupIndex }}, {{ $itemIndex }})"
                                                @disabled($itemIndex === count($group['items']) - 1) title="Move item down"
                                                class="px-4 py-2
                                                    bg-slate-700 text-gray-100
                                                    rounded-md border border-blue-500
                                                    hover:bg-slate-600 hover:border-blue-400
                                                    cursor-pointer transition inline-block text-center
                                                    disabled:cursor-not-allowed disabled:opacity-25">
                                                ↓
                                            </a>

                                        </div>

                                        <div class="flex gap-1">

                                            <a wire:click="insertItem({{ $groupIndex }}, {{ $itemIndex }})"
                                                title="Insert item below"
                                                class="px-4 py-2
                                                    bg-slate-700 text-gray-100
                                                    rounded-md border border-green-500
                                                    hover:bg-slate-600 hover:border-green-400
                                                    cursor-pointer transition inline-block text-center">
                                                +
                                            </a>

                                            <a wire:click="removeItem({{ $groupIndex }}, {{ $itemIndex }})"
                                                wire:confirm="Are you sure you want to remove this checklist item?"
                                                title="Remove item"
                                                class="px-4 py-2
                                                    bg-slate-700 text-gray-100
                                                    rounded-md border border-red-500
                                                    hover:bg-slate-600 hover:border-red-400
                                                    cursor-pointer transition inline-block text-center">
                                                ×
                                            </a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between
                    border-t border-gray-700 pt-5">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="px-4 py-2
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="!px-4 !py-2
                    !bg-slate-700 !text-gray-100
                    !rounded-md !border !border-green-500
                    hover:!bg-slate-600 hover:!border-green-400
                    !cursor-pointer !transition
                    inline-flex items-center justify-center
                    disabled:!cursor-not-allowed disabled:!opacity-50">

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
