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

<form wire:submit.prevent="save"
      class="mx-auto max-w-5xl space-y-6 rounded-3xl border border-gray-800 bg-gray-950 p-8 shadow-2xl shadow-black/40">

    {{-- Policy Header Information --}}
    <div class="{{ $sectionClass }}">
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
    <div class="{{ $sectionClass }}">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-white">
                Revision Dates
            </h3>

            <button type="button"
                    wire:click="addRevisionDate"
                    class="{{ $addButtonClass }}">
                Add Revision Date
            </button>
        </div>

        <div class="space-y-3">
            @foreach ($policy_revision_dates as $index => $revision)
                <div class="grid grid-cols-1 gap-3 rounded-xl border border-gray-800 bg-gray-950 p-4 md:grid-cols-3">

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
    </div>

    {{-- Table of Contents --}}
    <div class="{{ $sectionClass }}">
        <label class="{{ $labelClass }}">Table of Contents</label>

        <textarea
            wire:model="table_of_contents"
            rows="6"
            class="{{ $textareaClass }}"
        ></textarea>
    </div>

    {{-- Chapters --}}
    <div class="{{ $sectionClass }}">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-white">
                Policy Chapters
            </h3>

            <button type="button"
                    wire:click="addChapter"
                    class="{{ $addButtonClass }}">
                Add Chapter
            </button>
        </div>

        <div class="space-y-6">
            @foreach ($chapters as $chapterIndex => $chapter)

                <div class="rounded-2xl border border-gray-800 bg-gray-950 p-6 space-y-5">

                    <div class="flex flex-col gap-4 md:flex-row md:items-center">

                        <div class="flex-1 space-y-2">
                            <label class="{{ $labelClass }}">Chapter Title</label>

                            <input
                                type="text"
                                wire:model="chapters.{{ $chapterIndex }}.chapter_title"
                                placeholder="Chapter Title"
                                class="{{ $inputClass }}"
                            >
                        </div>

                        <button type="button"
                                wire:click="removeChapter({{ $chapterIndex }})"
                                class="{{ $removeButtonClass }}">
                            Remove Chapter
                        </button>

                    </div>

                    {{-- Sections --}}
                    <div class="space-y-5">

                        @foreach ($chapter['sections'] as $sectionIndex => $section)

                            <div class="rounded-xl border border-gray-800 bg-gray-900/60 p-5 space-y-5">

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

                                        <div class="rounded-xl border border-gray-800 bg-gray-950 p-5 space-y-4">

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

                                                    <div class="grid grid-cols-1 gap-3 rounded-xl border border-gray-800 bg-gray-900 p-4 md:grid-cols-3">

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

            @endforeach
        </div>
    </div>

    {{-- References --}}
    <div class="{{ $sectionClass }}">
        <label class="{{ $labelClass }}">References</label>

        <textarea
            wire:model="references"
            rows="5"
            class="{{ $textareaClass }}"
        ></textarea>
    </div>

    {{-- Definitions --}}
    <div class="{{ $sectionClass }}">
        <label class="{{ $labelClass }}">Definitions</label>

        <textarea
            wire:model="definitions"
            rows="5"
            class="{{ $textareaClass }}"
        ></textarea>
    </div>

    {{-- Submit --}}
    <div class="flex justify-end">
        <button type="submit"
                class="rounded-xl bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-green-950/40 transition hover:bg-green-500">
            Save Policy
        </button>
    </div>

</form>
