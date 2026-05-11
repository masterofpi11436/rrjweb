<form wire:submit.prevent="save" class="space-y-6">

    <div>
        <label>Title</label>
        <input type="text" wire:model="title" class="form-control">
    </div>

    <div>
        <label>Policy Statement</label>
        <textarea wire:model="policy_statement" class="form-control"></textarea>
    </div>

    <div>
        <label>Policy Purpose</label>
        <textarea wire:model="policy_purpose" class="form-control"></textarea>
    </div>

    <div>
        <label>Standards</label>
        <textarea wire:model="standards" class="form-control"></textarea>
    </div>

    <div>
        <label>American Correctional Association</label>
        <input type="text" wire:model="american_correctional_association" class="form-control">
    </div>

    <div>
        <label>VA Board of Local and Regional Jails</label>
        <input type="text" wire:model="va_board_of_local_and_regional_jails" class="form-control">
    </div>

    <div>
        <label>Prison Rape Elimination Act</label>
        <input type="text" wire:model="prison_rape_and_elimination_act" class="form-control">
    </div>

    <div>
        <label>NCCHC</label>
        <input type="text" wire:model="ncchc" class="form-control">
    </div>

    <div>
        <label>Policy Cross Reference</label>
        <input type="text" wire:model="policy_cross_reference" class="form-control">
    </div>

    <div>
        <label>Forms</label>
        <textarea wire:model="forms" class="form-control"></textarea>
    </div>

    <div>
        <label>Policy Effective Date</label>
        <input type="date" wire:model="policy_effective_date" class="form-control">
    </div>

    <hr>

    <h3>Revision Dates</h3>

    @foreach ($policy_revision_dates as $index => $revision)
        <div class="flex gap-2 items-center">
            <input
                type="text"
                wire:model="policy_revision_dates.{{ $index }}.revision"
                placeholder="Revision"
                class="form-control"
            >

            <input
                type="date"
                wire:model="policy_revision_dates.{{ $index }}.date"
                class="form-control"
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

    <h3>Policy Owner</h3>

    <div>
        <label>Policy Owner Signature</label>
        <input type="hidden" wire:model="policy_owner_signature" id="policy_owner_signature">
        <button type="button">Capture Signature</button>
    </div>

    <div>
        <label>Policy Owner Date</label>
        <input type="date" wire:model="policy_owner_date" class="form-control">
    </div>

    <h3>Policy Reviewer</h3>

    <div>
        <label>Policy Reviewer Signature</label>
        <input type="hidden" wire:model="policy_reviewer_signature" id="policy_reviewer_signature">
        <button type="button">Capture Signature</button>
    </div>

    <div>
        <label>Policy Reviewer Date</label>
        <input type="date" wire:model="policy_reviewer_date" class="form-control">
    </div>

    <h3>Superintendent Approval</h3>

    <div>
        <label>Superintendent Approval Signature</label>
        <input type="hidden" wire:model="superintendent_approval_signature" id="superintendent_approval_signature">
        <button type="button">Capture Signature</button>
    </div>

    <div>
        <label>Superintendent Approval Date</label>
        <input type="date" wire:model="superintendent_approval_date" class="form-control">
    </div>

    <hr>

    <div>
        <label>Table of Contents</label>
        <textarea wire:model="table_of_contents" class="form-control"></textarea>
    </div>

    <div>
        <label>References</label>
        <textarea wire:model="references" class="form-control"></textarea>
    </div>

    <div>
        <label>Definitions</label>
        <textarea wire:model="definitions" class="form-control"></textarea>
    </div>

    <button type="submit">
        Save Policy
    </button>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

</form>
