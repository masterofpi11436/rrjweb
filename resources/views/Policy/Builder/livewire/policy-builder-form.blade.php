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
        <input type="text" wire:model="va_board_of_local_and_regional_jails"">
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
