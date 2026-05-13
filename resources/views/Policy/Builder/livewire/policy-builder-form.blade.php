@php
    $labelClass = 'block text-sm font-medium text-gray-700';
    $inputClass = 'w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500';
    $textareaClass = 'w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500';
    $sectionClass = 'rounded-xl border border-gray-200 bg-gray-50 p-5 space-y-4';
    $addButtonClass = 'rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700';
    $removeButtonClass = 'rounded-lg bg-red-50 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-100';
@endphp

<form wire:submit.prevent="save" class="max-w-5xl mx-auto p-6 space-y-4 bg-white rounded-2xl shadow">

    {{-- Policy Header Information --}}
    <div class="space-y-2">
        <label class="{{ $labelClass }}">Title</label>
        <input type="text" wire:model="title" required class="{{ $inputClass }}">
    </div>

    <div class="space-y-2">
        <label class="{{ $labelClass }}">Policy Statement</label>
        <textarea wire:model="policy_statement" required class="{{ $inputClass }}"></textarea>
    </div>

    <div class="space-y-2">
        <label class="{{ $labelClass }}">Policy Purpose</label>
        <textarea wire:model="policy_purpose" required class="{{ $textareaClass }}"></textarea>
    </div>

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

    <div class="space-y-2">
        <label class="{{ $labelClass }}">Forms</label>
        <textarea wire:model="forms" class="{{ $textareaClass }}"></textarea>
    </div>

    <div class="space-y-2">
        <label class="{{ $labelClass }}">Policy Effective Date</label>
        <input type="date" wire:model="policy_effective_date" class="{{ $inputClass }}">
    </div>

    <hr>

    <h3>Revision Dates</h3>

    @foreach ($policy_revision_dates as $index => $revision)
        <div class="flex gap-2 items-center">
            <input
                type="text"
                wire:model="policy_revision_dates.{{ $index }}.revision"
                placeholder="Revision"
            >

            <input
                type="date"
                wire:model="policy_revision_dates.{{ $index }}.date"
            >

            <button type="button" wire:click="removeRevisionDate({{ $index }})">
                Remove
            </button>
        </div>
    @endforeach

    <button type="button" wire:click="addRevisionDate">
        Add Revision Date
    </button>

    <hr>

    <div>
        <label>Table of Contents</label>
        <textarea wire:model="table_of_contents"></textarea>
    </div>

    <hr>

    <h3>Policy Chapters</h3>

    @foreach ($chapters as $chapterIndex => $chapter)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">

            <label>Chapter Title</label>
            <input
                type="text"
                wire:model="chapters.{{ $chapterIndex }}.chapter_title"
                placeholder="Chapter Title"
            >

            <button type="button" wire:click="removeChapter({{ $chapterIndex }})">
                Remove Chapter
            </button>

            <h4>Paragraphs</h4>

            @foreach ($chapter['paragraphs'] as $paragraphIndex => $paragraph)
                <div style="border: 1px dashed #aaa; padding: 10px; margin-top: 10px;">

                    <label>Paragraph</label>
                    <textarea
                        wire:model="chapters.{{ $chapterIndex }}.paragraphs.{{ $paragraphIndex }}.paragraph"
                        placeholder="Paragraph text"
                    ></textarea>

                    <button
                        type="button"
                        wire:click="removeParagraph({{ $chapterIndex }}, {{ $paragraphIndex }})"
                    >
                        Remove Paragraph
                    </button>

                    <h5>Bullets</h5>

                    @foreach ($paragraph['bullets'] as $bulletIndex => $bullet)
                        <div class="flex gap-2 items-center">

                            <select wire:model="chapters.{{ $chapterIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.type">
                                <option value="bullet">Bullet</option>
                                <option value="ordered">Ordered</option>
                            </select>

                            <input
                                type="text"
                                wire:model="chapters.{{ $chapterIndex }}.paragraphs.{{ $paragraphIndex }}.bullets.{{ $bulletIndex }}.list"
                                placeholder="Bullet text"
                            >

                            <button
                                type="button"
                                wire:click="removeBullet({{ $chapterIndex }}, {{ $paragraphIndex }}, {{ $bulletIndex }})"
                            >
                                Remove Bullet
                            </button>

                        </div>
                    @endforeach

                    <button
                        type="button"
                        wire:click="addBullet({{ $chapterIndex }}, {{ $paragraphIndex }})"
                    >
                        Add Bullet
                    </button>

                </div>
            @endforeach

            <button type="button" wire:click="addParagraph({{ $chapterIndex }})">
                Add Paragraph
            </button>

        </div>
    @endforeach

    <button type="button" wire:click="addChapter">
        Add Chapter
    </button>

    <div>
        <label>References</label>
        <textarea wire:model="references"></textarea>
    </div>

    <div>
        <label>Definitions</label>
        <textarea wire:model="definitions"></textarea>
    </div>

    <button type="submit">
        Save Policy
    </button>
</form>
