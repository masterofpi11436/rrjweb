<form wire:submit.prevent="save" class="space-y-6">

    {{-- Policy Header Information --}}
    <div>
        <label>Title</label>
        <input type="text" wire:model="title" required>
    </div>

    <div>
        <label>Policy Statement</label>
        <textarea wire:model="policy_statement" required></textarea>
    </div>

    <div>
        <label>Policy Purpose</label>
        <textarea wire:model="policy_purpose" required></textarea>
    </div>

    <div>
        <label>Standards</label>
        <input type="text" wire:model="standards">
    </div>

    <div>
        <label>American Correctional Association</label>
        <input type="text" wire:model="american_correctional_association">
    </div>

    <div>
        <label>VA Board of Local and Regional Jails</label>
        <input type="text" wire:model="va_board_of_local_and_regional_jails">
    </div>

    <div>
        <label>Prison Rape Elimination Act</label>
        <input type="text" wire:model="prison_rape_and_elimination_act">
    </div>

    <div>
        <label>NCCHC</label>
        <input type="text" wire:model="ncchc">
    </div>

    <div>
        <label>Policy Cross Reference</label>
        <input type="text" wire:model="policy_cross_reference">
    </div>

    <div>
        <label>Forms</label>
        <textarea wire:model="forms"></textarea>
    </div>

    <div>
        <label>Policy Effective Date</label>
        <input type="date" wire:model="policy_effective_date">
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
