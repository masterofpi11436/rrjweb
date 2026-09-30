@php
    $labelClass = 'block text-sm font-medium text-gray-300';

    $inputClass = '
        w-full rounded-xl border border-gray-700 bg-gray-900
        px-4 py-3 text-sm text-white shadow-sm
        placeholder:text-gray-500
        focus:border-blue-500 focus:outline-none
        focus:ring-2 focus:ring-blue-500/40
    ';

    $sectionClass = '
        rounded-xl border border-gray-800
        bg-gray-900/80 p-4 space-y-4
        scroll-mt-24
    ';
@endphp

<div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 xl:pl-80">

    <aside class="fixed left-6 top-1/2 z-40 hidden w-64 -translate-y-1/2 xl:block 2xl:left-20">
        <div class="max-h-[80vh] overflow-y-auto rounded-2xl border border-gray-800 bg-gray-950 p-4 shadow-2xl">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-400">
                Book Navigation
            </h3>

            <nav class="space-y-2 text-sm">
                <a href="#book-info" class="block rounded-lg px-3 py-2 text-gray-300 hover:bg-gray-800">
                    Book Information
                </a>

                <div class="border-t border-gray-800 pt-3">
                    <div class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Parts ({{ count($parts) }})
                    </div>

                    <div class="ml-3 mt-2 space-y-1">
                        @foreach ($parts as $partIndex => $part)
                            <a href="#part-{{ $partIndex }}"
                                x-on:click="document.getElementById('part-{{ $partIndex }}')?.setAttribute('open', true)"
                                class="flex items-center gap-2 rounded-md px-2 py-2
                                        text-sm text-gray-400
                                        transition
                                        hover:bg-gray-800 hover:text-white">

                                <span
                                    class="flex h-6 w-6 shrink-0 items-center justify-center
                                            rounded bg-gray-800
                                            text-xs font-semibold text-gray-400">

                                    {{ $partIndex + 1 }}

                                </span>

                                <span class="truncate">
                                    {{ $part['title'] ?: 'Untitled Part' }}
                                </span>

                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-2 border-t border-gray-800 pt-4">
                    <a href="{{ route('training.admin.books.dashboard') }}"
                        class="block px-4 py-2 mb-4
                            bg-slate-700 text-gray-100
                            rounded-md border border-blue-500
                            hover:bg-slate-600 hover:border-blue-400
                            transition text-center">

                        Back
                    </a>

                    <a wire:click="save"
                        class="block px-4 py-2 mb-4
                            bg-slate-700 text-gray-100
                            rounded-md border border-green-500
                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                            transition text-center">
                        Save Book
                    </a>
                </div>
            </nav>
        </div>
    </aside>

    <form wire:submit="save" class="space-y-5 rounded-xl border border-gray-800 bg-gray-950 p-5">

        <div id="book-info" class="{{ $sectionClass }}">
            <h2 class="text-xl font-semibold text-white">Book Information</h2>

            <div class="space-y-2">
                <label for="book-title" class="{{ $labelClass }}">Title</label>

                <input id="book-title" type="text" wire:model="title" placeholder="Training book title"
                    class="{{ $inputClass }}">

                @error('title')
                    <p class="text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div id="parts" class="{{ $sectionClass }}">

            <div class="flex items-center justify-between gap-4">

                <h3 class="text-xl font-semibold text-white">
                    Book Parts
                    @error('parts')
                        <p class="text-sm font-light text-red-400"> {{ $message }}</p>
                    @enderror
                </h3>

                <a wire:click="addPart"
                    class="px-4 py-2 mb-4
                        bg-slate-700 text-gray-100
                        rounded-md border border-green-500
                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                        transition inline-block text-center">

                    Add Part

                </a>

            </div>

            <div class="space-y-6">
                @forelse ($parts as $partIndex => $part)
                    <details id="part-{{ $partIndex }}" wire:key="part-{{ $partIndex }}" x-data="{ open: true }"
                        x-bind:open="open" x-on:toggle="open = $el.open"
                        class="overflow-hidden rounded-xl border border-gray-700 bg-gray-950">

                        <summary class="cursor-pointer list-none border-b border-gray-700 bg-gray-800/80">

                            <div class="flex items-center justify-between gap-4 px-4 py-3">

                                <div class="flex items-center gap-4">

                                    {{-- Part Number --}}
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center
                           rounded-lg bg-blue-600/15
                           text-sm font-bold text-blue-400">

                                        {{ $partIndex + 1 }}

                                    </div>

                                    {{-- Part Information --}}
                                    <div>

                                        <div
                                            class="text-xs font-semibold uppercase
                               tracking-wider text-blue-400">

                                            Part {{ $partIndex + 1 }}

                                        </div>

                                        <h4 class="text-base font-semibold text-white">

                                            {{ $part['title'] ?: 'Untitled Part' }}

                                        </h4>

                                    </div>

                                </div>


                                <div class="flex items-center gap-4">

                                    {{-- Module Count --}}
                                    <span
                                        class="rounded-full bg-gray-700
                           px-3 py-1 text-xs text-gray-300">

                                        {{ count($part['modules'] ?? []) }}
                                        {{ count($part['modules'] ?? []) === 1 ? 'Module' : 'Modules' }}

                                    </span>

                                    {{-- Remove --}}
                                    <a wire:click.stop="removePart({{ $partIndex }})"
                                        class="inline-flex h-9 items-center justify-center
                           rounded-md border border-red-500
                           bg-gray-800 px-3
                           text-sm text-gray-300
                           transition
                           hover:bg-red-950/40 hover:text-white">

                                        Remove

                                    </a>

                                    {{-- Expand Indicator --}}
                                    <span class="text-gray-500">
                                        ▼
                                    </span>

                                </div>

                            </div>

                        </summary>

                        <div class="space-y-5 p-4">

                            {{-- Part Title --}}
                            <div class="space-y-2">

                                <label class="{{ $labelClass }}">
                                    Part Title
                                </label>

                                <input type="text" wire:model="parts.{{ $partIndex }}.title"
                                    placeholder="Part title" class="{{ $inputClass }}">

                                @error("parts.$partIndex.title")
                                    <p class="text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Modules --}}
                            <div class="space-y-3">

                                {{-- Module Header --}}
                                <div class="flex items-center justify-between border-t border-gray-800 pt-4">

                                    <div>
                                        <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-400">
                                            Modules
                                        </h5>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Training modules included in this part.
                                        </p>
                                    </div>

                                    <a wire:click="addModule({{ $partIndex }})"
                                        class="inline-flex cursor-pointer items-center justify-center
                       rounded-md border border-green-500
                       bg-slate-700 px-3 py-2
                       text-sm text-gray-100
                       transition
                       hover:border-green-400 hover:bg-slate-600">

                                        + Add Module

                                    </a>

                                </div>


                                @error("parts.$partIndex.modules")
                                    <p class="text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror


                                {{-- Module List --}}
                                <div class="space-y-3">

                                    @forelse ($part['modules'] ?? [] as $moduleIndex => $module)
                                        <div wire:key="module-{{ $partIndex }}-{{ $moduleIndex }}"
                                            class="rounded-lg border border-gray-800 bg-gray-900/60">

                                            {{-- Module Main Row --}}
                                            <div
                                                class="grid grid-cols-[40px_minmax(160px,1fr)_minmax(240px,2fr)_auto]
                               items-end gap-3 p-3">

                                                {{-- Module Number --}}
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center
                                    rounded-md bg-gray-800
                                    text-xs font-semibold text-gray-400">

                                                    {{ $moduleIndex + 1 }}

                                                </div>


                                                {{-- Module Type --}}
                                                <div class="space-y-1">

                                                    <label
                                                        class="block text-xs font-medium
                                       uppercase tracking-wide text-gray-500">

                                                        Module Type

                                                    </label>

                                                    <select
                                                        wire:model.live="parts.{{ $partIndex }}.modules.{{ $moduleIndex }}.module_type"
                                                        class="{{ $inputClass }}">

                                                        <option value="">
                                                            Select module type
                                                        </option>

                                                        <option value="paragraph">
                                                            Paragraph
                                                        </option>

                                                        <option value="media">
                                                            Media
                                                        </option>

                                                        <option value="form">
                                                            Form
                                                        </option>

                                                        <option value="checklist">
                                                            Checklist
                                                        </option>

                                                        <option value="sop_checklist">
                                                            SOP Checklist
                                                        </option>

                                                        <option value="test">
                                                            Test
                                                        </option>

                                                        <option value="evaluation">
                                                            Evaluation
                                                        </option>

                                                    </select>

                                                    @error("parts.$partIndex.modules.$moduleIndex.module_type")
                                                        <p class="text-xs text-red-400">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror

                                                </div>


                                                {{-- Existing Module --}}
                                                <div class="space-y-1">

                                                    <label
                                                        class="block text-xs font-medium
                                       uppercase tracking-wide text-gray-500">

                                                        Module

                                                    </label>

                                                    @php
                                                        $selectedType = $module['module_type'] ?? '';

                                                        $modulesForType = $availableModules[$selectedType] ?? [];
                                                    @endphp

                                                    <select
                                                        wire:model="parts.{{ $partIndex }}.modules.{{ $moduleIndex }}.module_id"
                                                        class="{{ $inputClass }}" @disabled(!$selectedType)>

                                                        @if (!$selectedType)
                                                            <option value="">
                                                                Select a module type first
                                                            </option>
                                                        @elseif (empty($modulesForType))
                                                            <option value="">
                                                                No modules available
                                                            </option>
                                                        @else
                                                            <option value="">
                                                                Select module
                                                            </option>

                                                            @foreach ($modulesForType as $availableModule)
                                                                <option value="{{ $availableModule['id'] }}">
                                                                    {{ $availableModule['title'] }}
                                                                </option>
                                                            @endforeach
                                                        @endif

                                                    </select>

                                                    @error("parts.$partIndex.modules.$moduleIndex.module_id")
                                                        <p class="text-xs text-red-400">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror

                                                </div>


                                                {{-- Remove Module --}}
                                                <a wire:click="removeModule({{ $partIndex }}, {{ $moduleIndex }})"
                                                    title="Remove Module"
                                                    class="inline-flex h-10 cursor-pointer
                                   items-center justify-center
                                   rounded-md border border-red-500
                                   bg-slate-700 px-3
                                   text-sm text-gray-300
                                   transition
                                   hover:border-red-400
                                   hover:bg-red-950/40
                                   hover:text-white">

                                                    Remove

                                                </a>

                                            </div>


                                            {{-- Required Signatures --}}
                                            <div class="border-t border-gray-800 px-3 py-3">

                                                <div class="flex items-start gap-6">

                                                    <div class="shrink-0">

                                                        <div
                                                            class="text-xs font-semibold
                                           uppercase tracking-wide
                                           text-gray-500">

                                                            Required Signatures

                                                        </div>

                                                    </div>


                                                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">

                                                        @foreach ($signerRoles as $role => $label)
                                                            <label
                                                                class="flex cursor-pointer
                                               items-center gap-2
                                               text-sm text-gray-300">

                                                                <input type="checkbox" value="{{ $role }}"
                                                                    wire:model="parts.{{ $partIndex }}.modules.{{ $moduleIndex }}.signoff_requirements"
                                                                    class="h-4 w-4 rounded
                                                   border-gray-600
                                                   bg-gray-900">

                                                                <span>
                                                                    {{ $label }}
                                                                </span>

                                                            </label>
                                                        @endforeach

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- Insert Between Modules --}}
                                            @unless ($loop->last)
                                                <div
                                                    class="flex justify-center
                                   border-t border-gray-800
                                   px-3 py-2">

                                                    <a wire:click="insertModuleAfter({{ $partIndex }}, {{ $moduleIndex }})"
                                                        class="cursor-pointer
                                       text-xs text-gray-500
                                       transition
                                       hover:text-gray-300">

                                                        + Insert Module Below

                                                    </a>

                                                </div>
                                            @endunless

                                        </div>

                                    @empty

                                        <div
                                            class="rounded-lg border border-dashed
                           border-gray-700
                           px-4 py-6 text-center">

                                            <p class="text-sm text-gray-500">
                                                No modules have been added to this part.
                                            </p>

                                            <a wire:click="addModule({{ $partIndex }})"
                                                class="mt-2 inline-block cursor-pointer
                               text-sm text-blue-400
                               hover:text-blue-300">

                                                + Add the first module

                                            </a>

                                        </div>
                                    @endforelse

                                </div>


                                {{-- Bottom Add Module --}}
                                @if (!empty($part['modules']))
                                    <a wire:click="addModule({{ $partIndex }})"
                                        class="block cursor-pointer rounded-md
                       border border-dashed border-gray-700
                       bg-transparent px-4 py-2
                       text-center text-sm text-gray-500
                       transition
                       hover:border-gray-600
                       hover:bg-gray-800/40
                       hover:text-gray-300">

                                        + Add Another Module

                                    </a>
                                @endif

                            </div>

                        </div>

                    </details>

                    @unless ($loop->last)
                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-800"></div>
                            </div>

                            <div class="relative flex justify-center">
                                <a wire:click="insertPartAfter({{ $partIndex }})"
                                    class="cursor-pointer rounded-full border border-dashed border-purple-500 bg-gray-950 px-4 py-2 text-sm text-purple-300 hover:bg-purple-950/40">
                                    + Insert Part
                                </a>
                            </div>
                        </div>
                    @endunless
                @empty
                    <p class="rounded-xl border border-dashed border-gray-700 p-5 text-sm text-gray-400">
                        No parts have been added to this book.
                    </p>
                @endforelse
                <a wire:click="addPart"
                    class="px-4 py-2 mb-4
                            bg-slate-700 text-gray-100
                            rounded-md border border-green-500
                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                            transition inline-block text-center">
                    Add Part
                </a>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="!px-4 !py-2 !mb-3
                    !bg-slate-700 !text-blue-400
                    !rounded-md !border !border-green-500
                    hover:!bg-slate-600 hover:!border-green-400 hover:underline
                    !cursor-pointer !transition
                    !inline-flex !items-center !justify-center
                    disabled:!cursor-not-allowed disabled:!opacity-50">

                <span wire:loading.remove wire:target="save">
                    {{ $trainingBookId ? 'Save Changes' : 'Create Book' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>

            </button>
        </div>
    </form>
</div>
