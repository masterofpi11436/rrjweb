<div class="relative w-full px-4 sm:px-6 lg:px-8 xl:pl-80 xl:pr-8">

    {{-- Fixed Sidebar Navigation --}}
    <aside class="fixed left-6 top-1/2 z-40 hidden w-64 -translate-y-1/2 xl:block 2xl:left-20">

        <div class="max-h-[80vh] overflow-y-auto rounded-2xl border border-gray-800 bg-gray-950 p-4 shadow-2xl">

            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-400">
                Module Navigation
            </h3>

            <nav class="space-y-2 text-sm">

                {{-- Module Information --}}
                <a href="#module-info" class="block rounded-lg px-3 py-2 text-gray-300 hover:bg-gray-800">
                    Module Information
                </a>

                {{-- Sections --}}
                <div class="border-t border-gray-800 pt-3">

                    <div class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Sections ({{ count($sections) }})
                    </div>

                    <div class="ml-3 mt-2 space-y-1">

                        @foreach ($sections as $sectionIndex => $section)
                            <a href="#section-{{ $sectionIndex }}"
                                class="block truncate rounded-lg px-3 py-1 text-xs text-gray-400 hover:bg-gray-800 hover:text-gray-200">
                                {{ $section['heading'] ?: 'Section ' . ($sectionIndex + 1) }}
                            </a>
                        @endforeach

                    </div>

                </div>

                {{-- Navigation Actions --}}
                <div class="space-y-2 border-t border-gray-800 pt-4">

                    <a href="{{ route('training.admin.modules.dashboard') }}"
                        class="block rounded-lg border border-gray-700 px-3 py-2 text-center text-sm text-gray-300 hover:bg-gray-800">
                        Back
                    </a>

                    <button type="submit" form="paragraph-form"
                        class="w-full rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500">
                        {{ $paragraphId ? 'Save Changes' : 'Save Module' }}
                    </button>

                </div>

            </nav>

        </div>

    </aside>

    {{-- Main Form --}}
    <form id="paragraph-form" wire:submit.prevent="save"
        class="w-full space-y-6 rounded-3xl border border-gray-800 bg-gray-950 p-4 shadow-2xl shadow-black/40 sm:p-6 lg:p-8 xl:max-w-[70vw]">

        {{-- Module Information --}}
        <div id="module-info"
            class="scroll-mt-24 space-y-5 rounded-2xl border border-gray-800 bg-gray-900/80 p-6 shadow-xl shadow-black/20">

            <h2 class="text-xl font-semibold text-white">
                Module Information
            </h2>

            {{-- Title --}}
            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-gray-300">
                    Paragraph Module Title
                </label>

                <input id="title" type="text" wire:model="title"
                    placeholder="Enter a title for this paragraph module"
                    class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40">

                @error('title')
                    <p class="mt-2 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-gray-300">
                    Module Description
                </label>

                <textarea id="description" wire:model="description" rows="3" placeholder="Enter an optional description"
                    class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

        {{-- Sections Header --}}
        <div class="rounded-2xl border border-gray-800 bg-gray-900/80 p-6 shadow-xl shadow-black/20">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <h2 class="text-xl font-semibold text-white">
                        Module Sections
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Create sections containing one or more paragraphs.
                    </p>
                </div>

                <button type="button" wire:click="addSection"
                    class="inline-flex items-center rounded-lg bg-blue-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                    Add Section
                </button>

            </div>

        </div>

        {{-- Individual Sections --}}
        @foreach ($sections as $sectionIndex => $section)
            <div id="section-{{ $sectionIndex }}" wire:key="section-{{ $section['id'] ?? 'new' }}-{{ $sectionIndex }}"
                class="scroll-mt-24 space-y-5 rounded-2xl border border-gray-800 bg-gray-900/80 p-6 shadow-xl shadow-black/20">

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <div>

                        <h3 class="text-lg font-semibold text-white">
                            {{ $section['heading'] ?: 'Section ' . ($sectionIndex + 1) }}
                        </h3>

                        <p class="text-sm text-gray-400">
                            {{ count($section['paragraphs'] ?? []) }}
                            paragraph(s)
                        </p>

                    </div>

                    <button type="button" wire:click="removeSection({{ $sectionIndex }})"
                        wire:confirm="Remove this section and all of its paragraphs?"
                        class="inline-flex items-center rounded-lg border border-red-900/50 bg-red-950/50 px-3 py-2 text-sm font-medium text-red-300 transition hover:bg-red-900/70 hover:text-white">
                        Remove Section
                    </button>

                </div>

                {{-- Section Heading --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-300">
                        Section Heading
                        <span class="font-normal text-gray-500">
                            (Optional)
                        </span>
                    </label>

                    <input type="text" wire:model="sections.{{ $sectionIndex }}.heading"
                        placeholder="Enter an optional section heading"
                        class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40">

                </div>

                {{-- Paragraphs --}}
                <div class="space-y-4 border-l-2 border-gray-800 pl-4">

                    <div class="flex items-center justify-between gap-4">

                        <h4 class="font-semibold text-gray-200">
                            Paragraphs
                        </h4>

                        <button type="button" wire:click="addParagraph({{ $sectionIndex }})"
                            class="inline-flex items-center rounded-lg bg-blue-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                            Add Paragraph
                        </button>

                    </div>

                    @foreach ($section['paragraphs'] ?? [] as $paragraphIndex => $paragraph)
                        <div wire:key="paragraph-{{ $sectionIndex }}-{{ $paragraphIndex }}"
                            class="space-y-4 rounded-xl border border-gray-800 bg-gray-900/60 p-4">

                            <div class="flex items-center justify-between gap-4">

                                <h5 class="font-semibold text-gray-200">
                                    Paragraph {{ $paragraphIndex + 1 }}
                                </h5>

                                <button type="button"
                                    wire:click="removeParagraph(
                                        {{ $sectionIndex }},
                                        {{ $paragraphIndex }}
                                    )"
                                    class="inline-flex items-center rounded-lg border border-red-900/50 bg-red-950/50 px-3 py-2 text-sm font-medium text-red-300 transition hover:bg-red-900/70 hover:text-white">
                                    Remove Paragraph
                                </button>

                            </div>


                            <textarea wire:model="sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.content" rows="5"
                                placeholder="Enter paragraph content"
                                class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>

                            @error("sections.$sectionIndex.paragraphs.$paragraphIndex.content")
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Lists --}}
                            <div class="space-y-4 border-l-2 border-gray-800 pl-4">

                                <div class="flex items-center justify-between gap-4">

                                    <div>

                                        <h6 class="font-semibold text-gray-200">
                                            Lists
                                        </h6>

                                        <p class="text-xs text-gray-500">
                                            Lists belong to this paragraph.
                                        </p>

                                    </div>

                                    <button type="button"
                                        wire:click="addList(
                                            {{ $sectionIndex }},
                                            {{ $paragraphIndex }}
                                        )"
                                        class="inline-flex items-center rounded-lg bg-blue-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                                        Add List
                                    </button>

                                </div>


                                @foreach ($paragraph['lists'] ?? [] as $listIndex => $list)
                                    <div wire:key="list-{{ $sectionIndex }}-{{ $paragraphIndex }}-{{ $listIndex }}"
                                        class="space-y-4 rounded-xl border border-gray-800 bg-gray-950 p-4">

                                        {{-- List Header --}}
                                        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

                                            {{-- List Type --}}
                                            <div class="flex-1">

                                                <label class="mb-2 block text-sm font-medium text-gray-300">
                                                    List Type
                                                </label>

                                                <select
                                                    wire:model="sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.lists.{{ $listIndex }}.type"
                                                    class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                                                    <option value="bullet">
                                                        Bullet List
                                                    </option>

                                                    <option value="ordered">
                                                        Numbered List
                                                    </option>
                                                </select>

                                                @error("sections.$sectionIndex.paragraphs.$paragraphIndex.lists.$listIndex.type")
                                                    <p class="mt-2 text-sm text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>


                                            {{-- Remove List --}}
                                            <button type="button"
                                                wire:click="removeList(
                    {{ $sectionIndex }},
                    {{ $paragraphIndex }},
                    {{ $listIndex }}
                )"
                                                class="inline-flex items-center rounded-lg border border-red-900/50 bg-red-950/50 px-3 py-2 text-sm font-medium text-red-300 transition hover:bg-red-900/70 hover:text-white">
                                                Remove List
                                            </button>

                                        </div>


                                        {{-- List Items --}}
                                        <div class="space-y-3 border-l-2 border-gray-800 pl-4">

                                            <div class="flex items-center justify-between gap-4">

                                                <h6 class="text-sm font-semibold text-gray-300">
                                                    List Items
                                                </h6>

                                                <button type="button"
                                                    wire:click="addListItem(
                        {{ $sectionIndex }},
                        {{ $paragraphIndex }},
                        {{ $listIndex }}
                    )"
                                                    class="inline-flex items-center rounded-lg bg-blue-800 px-3 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                                                    + Add List Item
                                                </button>

                                            </div>


                                            @error("sections.$sectionIndex.paragraphs.$paragraphIndex.lists.$listIndex.items")
                                                <p class="text-sm text-red-400">
                                                    {{ $message }}
                                                </p>
                                            @enderror


                                            @foreach ($list['items'] ?? [] as $itemIndex => $item)
                                                <div wire:key="list-item-{{ $sectionIndex }}-{{ $paragraphIndex }}-{{ $listIndex }}-{{ $itemIndex }}"
                                                    class="flex items-start gap-3">

                                                    {{-- Bullet / Number --}}
                                                    <div class="w-8 pt-3 text-center text-sm text-gray-400">

                                                        @if (($list['type'] ?? 'bullet') === 'ordered')
                                                            {{ $itemIndex + 1 }}.
                                                        @else
                                                            &bull;
                                                        @endif

                                                    </div>


                                                    {{-- Item Content --}}
                                                    <div class="flex-1">

                                                        <textarea
                                                            wire:model="sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.lists.{{ $listIndex }}.items.{{ $itemIndex }}.content"
                                                            rows="2" placeholder="Enter list item"
                                                            class="w-full rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 text-sm text-white shadow-sm placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>

                                                        @error("sections.$sectionIndex.paragraphs.$paragraphIndex.lists.$listIndex.items.$itemIndex.content")
                                                            <p class="mt-2 text-sm text-red-400">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror

                                                    </div>


                                                    {{-- Remove Item --}}
                                                    <button type="button"
                                                        wire:click="removeListItem(
                                                        {{ $sectionIndex }},
                                                        {{ $paragraphIndex }},
                                                        {{ $listIndex }},
                                                        {{ $itemIndex }}
                                                    )"
                                                        class="mt-1 inline-flex items-center rounded-lg border border-red-900/50 bg-red-950/50 px-3 py-2 text-sm font-medium text-red-300 transition hover:bg-red-900/70 hover:text-white">
                                                        Remove
                                                    </button>

                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                        {{-- Insert Paragraph Between Existing Paragraphs --}}
                        @unless ($loop->last)
                            <div class="relative py-2">

                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-800"></div>
                                </div>

                                <div class="relative flex justify-center">

                                    <button type="button"
                                        wire:click="insertParagraphAfter(
                                            {{ $sectionIndex }},
                                            {{ $paragraphIndex }}
                                        )"
                                        class="rounded-full border border-dashed border-purple-500 bg-gray-950 px-4 py-2 text-sm text-purple-300 hover:bg-purple-950/40">
                                        + Insert Paragraph
                                    </button>

                                </div>

                            </div>
                        @endunless
                    @endforeach

                    <button type="button" wire:click="addParagraph({{ $sectionIndex }})"
                        class="inline-flex items-center rounded-lg bg-blue-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                        Add Paragraph
                    </button>

                </div>

            </div>


            <button type="button" wire:click="addSection"
                class="inline-flex items-center rounded-lg bg-blue-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-900">
                Add Section
            </button>
        @endforeach


        {{-- Bottom Save --}}
        <div class="flex justify-end">

            <button type="submit"
                class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-green-950/40 transition hover:bg-green-500">
                {{ $paragraphId ? 'Save Changes' : 'Save Module' }}
            </button>

        </div>

    </form>

</div>
