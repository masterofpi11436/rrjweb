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
        rounded-2xl border border-gray-800
        bg-gray-900/80 p-6 space-y-4
        shadow-xl shadow-black/20
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
                                class="block truncate rounded-lg px-3 py-1 text-xs text-gray-400 hover:bg-gray-800 hover:text-gray-200">
                                {{ $part['title'] ?: 'Untitled Part ' . ($partIndex + 1) }}
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

    <form wire:submit="save"
        class="mx-auto max-w-5xl space-y-6 rounded-3xl border border-gray-800 bg-gray-950 p-4 shadow-2xl shadow-black/40 sm:p-6 lg:p-8">

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
                        class="rounded-2xl border border-gray-800 bg-gray-950 p-6">

                        <summary class="cursor-pointer list-none">
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">
                                        {{ $part['title'] ?: 'Untitled Part ' . ($partIndex + 1) }}
                                    </h4>
                                    <p class="text-sm text-gray-400">
                                        {{ count($part['modules'] ?? []) }} module(s)
                                    </p>
                                </div>

                                <a wire:click.stop="removePart({{ $partIndex }})"
                                    class="px-4 py-2 mb-4
                                        bg-slate-700 text-gray-100
                                        rounded-md border border-red-500
                                        hover:bg-slate-600 hover:border-red-400 cursor-pointer
                                        transition inline-block text-center">
                                    Remove Part
                                </a>
                            </div>
                        </summary>

                        <div class="mt-5 space-y-6">
                            <div class="space-y-2">
                                <label class="{{ $labelClass }}">Part Title</label>

                                <input type="text" wire:model="parts.{{ $partIndex }}.title"
                                    placeholder="Part title" class="{{ $inputClass }}">

                                @error("parts.$partIndex.title")
                                    <p class="text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-4 border-l-2 border-gray-800 pl-4">
                                <div class="flex items-center justify-between gap-4">
                                    <h5 class="font-semibold text-gray-200">Modules</h5>

                                    <a wire:click="addModule({{ $partIndex }})"
                                        class="px-4 py-2 mb-4
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-green-500
                                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                            transition inline-block text-center">
                                        Add Module
                                    </a>
                                </div>

                                @error("parts.$partIndex.modules")
                                    <p class="text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                                @forelse ($part['modules'] ?? [] as $moduleIndex => $module)
                                    <div wire:key="module-{{ $partIndex }}-{{ $moduleIndex }}"
                                        class="space-y-4 rounded-xl border border-gray-800 bg-gray-900/60 p-4">

                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_2fr_auto] md:items-end">

                                            {{-- Module Type --}}
                                            <div class="space-y-2">
                                                <label class="{{ $labelClass }}">
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
                                                    <p class="text-sm text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>


                                            {{-- Existing Module --}}
                                            <div class="space-y-2">

                                                <label class="{{ $labelClass }}">
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
                                                    <p class="text-sm text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>


                                            {{-- Remove --}}
                                            <a wire:click="removeModule({{ $partIndex }}, {{ $moduleIndex }})"
                                                class="px-4 py-2 mb-4
                                                    bg-slate-700 text-gray-100
                                                    rounded-md border border-red-500
                                                    hover:bg-slate-600 hover:border-red-400 cursor-pointer
                                                    transition inline-block text-center">
                                                Remove Module
                                            </a>

                                        </div>

                                        {{-- Required Signatures --}}
                                        <div class="mt-4 border-t border-gray-700 pt-4">

                                            <div class="mb-3 font-semibold text-gray-200">
                                                Required Signatures
                                            </div>

                                            <div class="grid grid-cols-2 gap-3 md:grid-cols-3">

                                                @foreach ($signerRoles as $role => $label)
                                                    <label class="flex items-center gap-2 text-gray-300">

                                                        <input type="checkbox" value="{{ $role }}"
                                                            wire:model="parts.{{ $partIndex }}.modules.{{ $moduleIndex }}.signoff_requirements"
                                                            class="rounded border-gray-600">

                                                        <span>
                                                            {{ $label }}
                                                        </span>

                                                    </label>
                                                @endforeach

                                            </div>

                                        </div>


                                        {{-- Insert Between Modules --}}
                                        @unless ($loop->last)
                                            <div class="flex justify-center border-t border-gray-800 pt-3">

                                                <a wire:click="insertModuleAfter({{ $partIndex }}, {{ $moduleIndex }})"
                                                    class="px-4 py-2
                                                        bg-slate-700 text-gray-100
                                                        rounded-md border border-purple-500
                                                        hover:bg-slate-600 hover:border-purple-400 cursor-pointer
                                                        transition inline-block text-center">
                                                    + Insert Module
                                                </a>

                                            </div>
                                        @endunless

                                    </div>

                                @empty

                                    <p
                                        class="rounded-xl border border-dashed border-gray-700 p-4 text-sm text-gray-400">
                                        No modules have been added to this part.
                                    </p>
                                @endforelse
                                <a wire:click="addModule({{ $partIndex }})"
                                    class="px-4 py-2 mb-4
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-green-500
                                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                            transition inline-block text-center">
                                    Add Module
                                </a>
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
