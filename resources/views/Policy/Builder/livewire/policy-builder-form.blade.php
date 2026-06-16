@php
    $labelClass = 'block text-sm font-medium text-gray-300';

    $inputClass = '
        w-full rounded-xl border border-gray-700 bg-gray-900
        px-4 py-3 text-sm text-white shadow-sm
        placeholder:text-gray-500
        focus:border-blue-500 focus:outline-none
        focus:ring-2 focus:ring-blue-500/40
    ';

    $textareaClass = '
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
        bg-blue-600 px-4 py-2 text-sm font-medium
        text-white transition hover:bg-blue-500
    ';

    $removeButtonClass = '
        inline-flex items-center rounded-lg
        border border-red-900/50 bg-red-950/50
        px-3 py-2 text-sm font-medium text-red-300
        transition hover:bg-red-900/70 hover:text-white
    ';
@endphp

<div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 xl:pl-80">

    {{-- Floating nav --}}
    <aside class="hidden xl:block fixed left-6 2xl:left-20 top-1/2 z-40 w-64 -translate-y-1/2">
        <div class="max-h-[80vh] overflow-y-auto rounded-2xl border border-gray-800 bg-gray-950 p-4 shadow-2xl">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-400">
                Policy Navigation
            </h3>

            <nav class="space-y-2 text-sm">

                <a href="#policy-info" class="block rounded-lg px-3 py-2 text-gray-300 hover:bg-gray-800">
                    Policy Information
                </a>

                <a href="#revision-dates" class="block rounded-lg px-3 py-2 text-gray-300 hover:bg-gray-800">
                    Revision Dates
                </a>

                {{-- Chapters --}}
                <div class="pt-3">
                    <div class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Chapters ({{ count($chapters) }})
                    </div>

                    <div class="ml-3 mt-2 space-y-1">
                        @foreach ($chapters as $chapterIndex => $chapter)
                            <a href="#chapter-{{ $chapterIndex }}"
                            x-on:click="document.getElementById('chapter-{{ $chapterIndex }}')?.setAttribute('open', true)"
                            class="block truncated rounded-lg px-3 py-1 text-xs text-gray-400 hover:bg-gray-800 hover:text-gray-200">
                                {{ $chapter['chapter_title'] ?: 'Untitled Chapter ' . ($chapterIndex + 1) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- References --}}
                <div class="pt-3 border-t border-gray-800">
                    <div class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        References ({{ count($references) }})
                    </div>

                    <div class="ml-3 mt-2 space-y-1">
                        @foreach ($references as $referenceIndex => $reference)
                            <a href="#reference-{{ $referenceIndex }}"
                            x-on:click="document.getElementById('reference-{{ $referenceIndex }}')?.setAttribute('open', true)"
                            class="block truncated rounded-lg px-3 py-1 text-xs text-gray-400 hover:bg-gray-800 hover:text-gray-200">
                                {{ $reference['reference_title'] ?: 'Untitled Reference ' . ($referenceIndex + 1) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-800">
                    <a href="#definitions" class="block rounded-lg px-3 py-2 text-gray-300 hover:bg-gray-800">
                        Definitions
                    </a>
                </div>
                    <div class="border-t border-gray-800 pt-4 space-y-2">
                        <a href="{{ route('policy.builder.index') }}"
                        class="block rounded-lg border border-gray-700 px-3 py-2 text-center text-sm text-gray-300 hover:bg-gray-800">
                            Back
                        </a>

                        <button type="submit"
                                form="policy-builder-form"
                                class="w-full rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500">
                            Save Policy
                        </button>
                    </div>
            </nav>
        </div>
    </aside>

    <form id="policy-builder-form"
          class="mx-auto max-w-5xl space-y-6 rounded-3xl border border-gray-800 bg-gray-950 p-4 sm:p-6 lg:p-8 shadow-2xl shadow-black/40">

        {{-- Policy Header Information --}}
        <div id="policy-info" class="{{ $sectionClass }} scroll-mt-50">
            <h2 class="text-xl font-semibold text-white">
                Policy Information
            </h2>

            <div class="space-y-2">
                <label class="{{ $labelClass }}">Title</label>
                <input type="text" wire:model="title" required class="{{ $inputClass }}">
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}">Policy Statement</label>
                <textarea wire:model="policy_statement" required rows="4" class="{{ $textareaClass }}"></textarea>
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}">Policy Purpose</label>
                <textarea wire:model="policy_purpose" required rows="4" class="{{ $textareaClass }}"></textarea>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">Standards</label>
                    <input type="text" wire:model="standards" class="{{ $inputClass }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">American Correctional Association</label>
                    <input type="text" wire:model="american_correctional_association" class="{{ $inputClass }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">VA Board of Local and Regional Jails</label>
                    <input type="text" wire:model="va_board_of_local_and_regional_jails" class="{{ $inputClass }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">Prison Rape Elimination Act</label>
                    <input type="text" wire:model="prison_rape_and_elimination_act" class="{{ $inputClass }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">NCCHC</label>
                    <input type="text" wire:model="ncchc" class="{{ $inputClass }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}">Policy Cross Reference</label>
                    <input type="text" wire:model="policy_cross_reference" class="{{ $inputClass }}">
                </div>

            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}">Forms</label>
                <textarea wire:model="forms" rows="4" class="{{ $textareaClass }}"></textarea>
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}">Policy Effective Date</label>
                <input type="date" wire:model="policy_effective_date" class="{{ $inputClass }}">
            </div>
        </div>

        {{-- Revision Dates --}}
        <div id="revision-dates" class="{{ $sectionClass }}" x-data="{ revisionOpen: false }">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">
                    Revision Dates
                </h3>

                <button type="button"
                        wire:click="addRevisionDate"
                        x-on:click="revisionOpen = true"
                        class="{{ $addButtonClass }}">
                    Add Revision Date
                </button>
            </div>

            <details
                x-bind:open="revisionOpen"
                x-on:toggle="revisionOpen = $el.open"
                class="rounded-xl border border-gray-800 bg-gray-950 p-4"
            >
                <summary class="cursor-pointer list-none text-sm font-medium text-gray-300">
                    Show / Hide Revision Entries
                </summary>

                <div class="mt-4 space-y-3">
                    @foreach ($policy_revision_dates as $index => $revision)
                        <div
                            wire:key="revision-date-{{ $index }}"
                            class="grid grid-cols-1 gap-3 rounded-xl border border-gray-800 bg-gray-950 p-4 md:grid-cols-3"
                        >
                            <input
                                type="text"
                                wire:model="policy_revision_dates.{{ $index }}.revision"
                                placeholder="Revision"
                                class="{{ $inputClass }}"
                            >

                            <input
                                type="date"
                                wire:model="policy_revision_dates.{{ $index }}.date"
                                class="{{ $inputClass }}"
                            >

                            <button type="button"
                                    wire:click="removeRevisionDate({{ $index }})"
                                    class="{{ $removeButtonClass }}">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>
            </details>
        </div>

        {{-- Chapters --}}
        <div id="chapters" class="{{ $sectionClass }}">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white">
                    Policy Chapters
                </h3>
            </div>

            <div class="space-y-6">
                @foreach ($chapters as $chapterIndex => $chapter)

                        <details
                            id="chapter-{{ $chapterIndex }}"
                            wire:key="chapter-{{ $chapterIndex }}"
                            x-data="{ open: false }"
                            x-bind:open="open"
                            x-on:toggle="open = $el.open"
                            class="rounded-2xl border border-gray-800 bg-gray-950 p-6"
                        >
                        <summary class="cursor-pointer list-none">
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">
                                        {{ $chapter['chapter_title'] ?: 'Untitled Chapter' }}
                                    </h4>

                                    <p class="text-sm text-gray-400">
                                        Click to expand/collapse
                                    </p>
                                </div>

                                <button type="button"
                                        wire:click.stop="insertChapterAfter({{ $chapterIndex }})"
                                        class="{{ $addButtonClass }}">
                                    Insert Chapter Below
                                </button>

                                <button type="button"
                                        wire:click.stop="removeChapter({{ $chapterIndex }})"
                                        class="{{ $removeButtonClass }}">
                                    Remove Chapter
                                </button>
                            </div>
                        </summary>

                        <div class="mt-5 space-y-5">
                            <div class="space-y-2">
                                <label class="{{ $labelClass }}">Chapter Title</label>

                                <input
                                    type="text"
                                    wire:model="chapters.{{ $chapterIndex }}.chapter_title"
                                    placeholder="Chapter Title"
                                    class="{{ $inputClass }}"
                                >
                            </div>

                            {{-- Sections --}}
                            <div class="space-y-5">

                                @foreach ($chapter['sections'] as $sectionIndex => $section)

                                        <div
                                            wire:key="section-{{ $chapterIndex }}-{{ $sectionIndex }}"
                                            class="rounded-xl border border-gray-800 bg-gray-900/60 p-5 space-y-5"
                                        >

                                        <div class="flex flex-col gap-4 md:flex-row md:items-center">
                                            <div class="flex-1 space-y-2">
                                                <label class="{{ $labelClass }}">Section Title</label>

                                                <input
                                                    type="text"
                                                    wire:model="chapters.{{ $chapterIndex }}.sections.{{ $sectionIndex }}.section_title"
                                                    placeholder="Section Title"
                                                    class="{{ $inputClass }}"
                                                >
                                            </div>

                                            <button
                                                type="button"
                                                wire:click="removeSection({{ $chapterIndex }}, {{ $sectionIndex }})"
                                                class="{{ $removeButtonClass }}"
                                            >
                                                Remove Section
                                            </button>
                                        </div>

                                        {{-- Paragraphs --}}
                                        <div class="space-y-5">

                                            @foreach ($section['paragraphs'] as $paragraphIndex => $paragraph)

                                                    <div
                                                        wire:key="paragraph-{{ $chapterIndex }}-{{ $sectionIndex }}-{{ $paragraphIndex }}"
                                                        class="rounded-xl border border-gray-800 bg-gray-950 p-5 space-y-4"
                                                    >

                                                    <div class="space-y-2">
                                                        <label class="{{ $labelClass }}">Paragraph</label>

                                                        <textarea
                                                            wire:model="chapters.{{ $chapterIndex }}.sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.paragraph"
                                                            placeholder="Paragraph text"
                                                            rows="4"
                                                            class="{{ $textareaClass }}"
                                                        ></textarea>
                                                    </div>

                                                    <button
                                                        type="button"
                                                        wire:click="removeParagraph({{ $chapterIndex }}, {{ $sectionIndex }}, {{ $paragraphIndex }})"
                                                        class="{{ $removeButtonClass }}"
                                                    >
                                                        Remove Paragraph
                                                    </button>

                                                    {{-- Bullets --}}
                                                    <div class="space-y-4">

                                                        <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-400">
                                                            Bullets
                                                        </h5>

                                                        @foreach ($paragraph['bullets'] as $bulletIndex => $bullet)

                                                            <div
                                                                wire:key="bullet-{{ $chapterIndex }}-{{ $sectionIndex }}-{{ $paragraphIndex }}-{{ $bulletIndex }}"
                                                                class="grid grid-cols-1 gap-3 rounded-xl border border-gray-800 bg-gray-900 p-4 md:grid-cols-3"
                                                            >

                                                                <select
                                                                    wire:model="chapters.{{ $chapterIndex }}.sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.type"
                                                                    class="{{ $inputClass }}"
                                                                >
                                                                    <option value="bullet">Bullet</option>
                                                                    <option value="ordered">Ordered</option>
                                                                </select>

                                                                <input
                                                                    type="text"
                                                                    wire:model="chapters.{{ $chapterIndex }}.sections.{{ $sectionIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.list"
                                                                    placeholder="Bullet text"
                                                                    class="{{ $inputClass }}"
                                                                >

                                                                <button
                                                                    type="button"
                                                                    wire:click="removeBullet({{ $chapterIndex }}, {{ $sectionIndex }}, {{ $paragraphIndex }}, {{ $bulletIndex }})"
                                                                    class="{{ $removeButtonClass }}"
                                                                >
                                                                    Remove Bullet
                                                                </button>

                                                            </div>

                                                        @endforeach

                                                        <button
                                                            type="button"
                                                            wire:click="addBullet({{ $chapterIndex }}, {{ $sectionIndex }}, {{ $paragraphIndex }})"
                                                            class="{{ $addButtonClass }}"
                                                        >
                                                            Add Bullet
                                                        </button>

                                                    </div>

                                                </div>

                                            @endforeach

                                            <button
                                                type="button"
                                                wire:click="addParagraph({{ $chapterIndex }}, {{ $sectionIndex }})"
                                                class="{{ $addButtonClass }}"
                                            >
                                                Add Paragraph
                                            </button>

                                        </div>

                                    </div>

                                @endforeach

                                <button
                                    type="button"
                                    wire:click="addSection({{ $chapterIndex }})"
                                    class="{{ $addButtonClass }}"
                                >
                                    Add Section
                                </button>

                            </div>
                        </div>
                    </details>

                @endforeach

                <button type="button"
                        wire:click="addChapter"
                        class="{{ $addButtonClass }}">
                    Add Chapter
                </button>
            </div>
        </div>

        {{-- References --}}
        <div id="references" class="{{ $sectionClass }}">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white">
                    Policy References
                </h3>
            </div>

            <div class="space-y-6">
                @foreach ($references as $referenceIndex => $reference)

                        <details
                            id="reference-{{ $referenceIndex }}"
                            wire:key="reference-{{ $referenceIndex }}"
                            x-data="{ open: false }"
                            x-bind:open="open"
                            x-on:toggle="open = $el.open"
                            class="rounded-2xl border border-gray-800 bg-gray-950 p-6"
                        >
                        <summary class="cursor-pointer list-none">
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">
                                        {{ $reference['reference_title'] ?: 'Untitled Reference' }}
                                    </h4>

                                    <p class="text-sm text-gray-400">
                                        Click to expand/collapse
                                    </p>
                                </div>

                                <button type="button"
                                        wire:click.stop="insertReferenceAfter({{ $referenceIndex }})"
                                        class="{{ $addButtonClass }}">
                                    Insert Reference Below
                                </button>

                                <button type="button"
                                        wire:click.stop="removeReference({{ $referenceIndex }})"
                                        class="{{ $removeButtonClass }}">
                                    Remove Reference
                                </button>
                            </div>
                        </summary>

                        <div class="mt-5 space-y-5">
                            <div class="space-y-2">
                                <label class="{{ $labelClass }}">Reference Title</label>

                                <input
                                    type="text"
                                    wire:model="references.{{ $referenceIndex }}.reference_title"
                                    placeholder="Reference Title"
                                    class="{{ $inputClass }}"
                                >
                            </div>

                                    {{-- Paragraphs --}}
                                    <div class="space-y-5">
                                        @foreach ($reference['paragraphs'] as $paragraphIndex => $paragraph)
                                                <div
                                                    wire:key="reference-paragraph-{{ $referenceIndex }}-{{ $paragraphIndex }}"
                                                    class="rounded-xl border border-gray-800 bg-gray-950 p-5 space-y-4"
                                                >

                                                <div class="space-y-2">

                                                    <div class="space-y-2">
                                                        <label class="{{ $labelClass }}">ACA Reference</label>
                                                        <input
                                                            type="text"
                                                            wire:model="references.{{ $referenceIndex }}.paragraphs.{{ $paragraphIndex }}.aca_reference"
                                                            class="{{ $inputClass }}"
                                                        >
                                                    </div>

                                                    <label class="{{ $labelClass }}">Paragraph</label>

                                                    <textarea
                                                        wire:model="references.{{ $referenceIndex }}.paragraphs.{{ $paragraphIndex }}.paragraph"
                                                        placeholder="Paragraph text"
                                                        rows="4"
                                                        class="{{ $textareaClass }}"
                                                    ></textarea>
                                                </div>

                                                <button
                                                    type="button"
                                                    wire:click="removeReferenceParagraph({{ $referenceIndex }}, {{ $paragraphIndex }})"
                                                    class="{{ $removeButtonClass }}"
                                                >
                                                    Remove Paragraph
                                                </button>

                                                {{-- Bullets --}}
                                                <div class="space-y-4">

                                                    <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-400">
                                                        Bullets
                                                    </h5>

                                                    @foreach ($paragraph['bullets'] as $bulletIndex => $bullet)

                                                        <div
                                                            wire:key="reference-bullet-{{ $referenceIndex }}-{{ $paragraphIndex }}-{{ $bulletIndex }}"
                                                            class="grid grid-cols-1 gap-3 rounded-xl border border-gray-800 bg-gray-900 p-4 md:grid-cols-3"
                                                        >

                                                            <select
                                                                wire:model="references.{{ $referenceIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.type"
                                                                class="{{ $inputClass }}"
                                                            >
                                                                <option value="bullet">Bullet</option>
                                                                <option value="ordered">Ordered</option>
                                                            </select>

                                                            <input
                                                                type="text"
                                                                wire:model="references.{{ $referenceIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.list"
                                                                placeholder="Bullet text"
                                                                class="{{ $inputClass }}"
                                                            >

                                                            <button
                                                                type="button"
                                                                wire:click="removeReferenceBullet({{ $referenceIndex }}, {{ $paragraphIndex }}, {{ $bulletIndex }})"
                                                                class="{{ $removeButtonClass }}"
                                                            >
                                                                Remove Bullet
                                                            </button>

                                                        </div>
                                                    @endforeach
                                                    <button
                                                        type="button"
                                                        wire:click="addReferenceBullet({{ $referenceIndex }}, {{ $paragraphIndex }})"
                                                        class="{{ $addButtonClass }}"
                                                    >
                                                        Add Bullet
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach

                                        <button
                                            type="button"
                                            wire:click="addReferenceParagraph({{ $referenceIndex }})"
                                            class="{{ $addButtonClass }}"
                                        >
                                            Add Paragraph
                                        </button>
                                    </div>
                                </div>
                            </details>

                @endforeach

                <button type="button"
                        wire:click="addReference"
                        class="{{ $addButtonClass }}">
                    Add Reference
                </button>
            </div>
        </div>

        {{-- Definitions --}}
        <div id="definitions" class="{{ $sectionClass }}" x-data="{ definitionsOpen: false }">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">
                    Definitions
                </h3>

                <button type="button"
                        wire:click="addDefinition"
                        x-on:click="definitionsOpen = true"
                        class="{{ $addButtonClass }}">
                    Add Definition
                </button>
            </div>

            <details
                x-bind:open="definitionsOpen"
                x-on:toggle="definitionsOpen = $el.open"
                class="rounded-xl border border-gray-800 bg-gray-950 p-4"
            >
                <summary class="cursor-pointer list-none text-sm font-medium text-gray-300">
                    Show / Hide Definition Entries
                </summary>

                <div class="mt-4 space-y-3">
                    @foreach ($definitions as $index => $definition)
                        <div
                            wire:key="definition-{{ $index }}"
                            class="space-y-3 rounded-xl border border-gray-800 bg-gray-950 p-4"
                        >
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                                <input
                                    type="text"
                                    wire:model="definitions.{{ $index }}.word"
                                    placeholder="Word / Title"
                                    class="{{ $inputClass }}"
                                >

                                <button type="button"
                                        wire:click="removeDefinition({{ $index }})"
                                        class="{{ $removeButtonClass }} md:col-start-3">
                                    Remove
                                </button>
                            </div>

                            <textarea
                                wire:model="definitions.{{ $index }}.definition"
                                rows="5"
                                placeholder="Definition"
                                class="{{ $textareaClass }}"
                            ></textarea>
                        </div>
                    @endforeach
                </div>
            </details>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-green-950/40 transition hover:bg-green-500">
                Save Policy
            </button>
        </div>

    </form>

</div>

