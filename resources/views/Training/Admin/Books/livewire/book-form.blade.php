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

    $addButtonClass = '
        inline-flex items-center rounded-lg
        bg-blue-800 px-4 py-2 text-sm font-medium
        text-white transition hover:bg-blue-900
    ';

    $removeButtonClass = '
        inline-flex items-center rounded-lg
        border border-red-900/50 bg-red-950/50
        px-3 py-2 text-sm font-medium text-red-300
        transition hover:bg-red-900/70 hover:text-white
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
                        class="block rounded-lg border border-gray-700 px-3 py-2 text-center text-sm text-gray-300 hover:bg-gray-800">
                        Back
                    </a>

                    <button type="submit" form="book-form"
                        class="w-full rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500">
                        Save Book
                    </button>
                </div>
            </nav>
        </div>
    </aside>

    <form id="book-form" wire:submit.prevent="save"
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
                <h3 class="text-xl font-semibold text-white">Book Parts</h3>

                <button type="button" wire:click="addPart" class="{{ $addButtonClass }}">
                    Add Part
                </button>
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

                                <button type="button" wire:click.stop="removePart({{ $partIndex }})"
                                    class="{{ $removeButtonClass }}">
                                    Remove Part
                                </button>
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

                                    <button type="button" wire:click="addModule({{ $partIndex }})"
                                        class="{{ $addButtonClass }}">
                                        Add Module
                                    </button>
                                </div>

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
                                            <button type="button"
                                                wire:click="removeModule({{ $partIndex }}, {{ $moduleIndex }})"
                                                class="{{ $removeButtonClass }}">
                                                Remove Module
                                            </button>

                                        </div>


                                        {{-- Insert Between Modules --}}
                                        @unless ($loop->last)
                                            <div class="flex justify-center border-t border-gray-800 pt-3">

                                                <button type="button"
                                                    wire:click="insertModuleAfter({{ $partIndex }}, {{ $moduleIndex }})"
                                                    class="rounded-full border border-dashed border-purple-500 px-4 py-2 text-sm text-purple-300 hover:bg-purple-950/40">
                                                    + Insert Module
                                                </button>

                                            </div>
                                        @endunless

                                    </div>

                                @empty

                                    <p
                                        class="rounded-xl border border-dashed border-gray-700 p-4 text-sm text-gray-400">
                                        No modules have been added to this part.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    </details>

                    @unless ($loop->last)
                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-800"></div>
                            </div>

                            <div class="relative flex justify-center">
                                <button type="button" wire:click="insertPartAfter({{ $partIndex }})"
                                    class="rounded-full border border-dashed border-purple-500 bg-gray-950 px-4 py-2 text-sm text-purple-300 hover:bg-purple-950/40">
                                    + Insert Part
                                </button>
                            </div>
                        </div>
                    @endunless
                @empty
                    <p class="rounded-xl border border-dashed border-gray-700 p-5 text-sm text-gray-400">
                        No parts have been added to this book.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-green-950/40 transition hover:bg-green-500">
                Save Book
            </button>
        </div>
    </form>
</div>
