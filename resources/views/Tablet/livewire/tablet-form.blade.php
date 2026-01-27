<form wire:submit.prevent="submitForm">

    <fieldset>
        <legend>Paste Inmate Information</legend>
        <div>
            <label for="paste_input">Paste Info Here:</label>
            <input id="paste_input" type="text" placeholder="Paste inmate details here">
        </div>
    </fieldset>

    <fieldset>
        <legend>Inmate Information</legend>
        <div class="field-group">
            <div>
                <label for="inmate_number">Inmate Number:</label>
                <input id="inmate_number" type="text" wire:model.live="inmate_number">
                @error('inmate_number') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" wire:model.live="last_name">
                @error('last_name') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" wire:model.live="first_name">
                @error('first_name') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="middle_name">Middle Name</label>
                <input id="middle_name" type="text" wire:model.live="middle_name">
                @error('middle_name') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date_found">Date Found</label>
                <input id="date_found" type="date" wire:model.live="date_found">
                @error('date_found') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Additional Information</legend>
        <div class="checkbox-group">
            <div>
                <label for="charged_101">Charged with 101?</label>
                <input type="checkbox" id="charged_101" wire:model.defer="charged_101" {{ $charged_101 ? 'checked' : '' }}>
            </div>

            <div>
                <label for="filed_with_inmate_accounts">Filed with Inmate Accounts?</label>
                <input type="checkbox" id="filed_with_inmate_accounts" wire:model.defer="filed_with_inmate_accounts" {{ $filed_with_inmate_accounts ? 'checked' : '' }}>
            </div>

            <div>
                <label for="charged_by_inmate_accounts">Charged by Inmate Accounts?</label>
                <input type="checkbox" id="charged_by_inmate_accounts" wire:model.defer="charged_by_inmate_accounts" {{ $charged_by_inmate_accounts ? 'checked' : '' }}>
            </div>

            <div>
                <label for="payment_status">Payment Status?</label>
                <input type="checkbox" id="payment_status" wire:model.defer="payment_status" {{ $payment_status ? 'checked' : '' }}>
            </div>
        </div>
    </fieldset>

    <div>
        <label for="note">Notes:</label>
        <textarea id="note" wire:model.live="note"></textarea>
    </div>

    <div>
        <button type="submit">{{ $tabletId ? 'Update Record' : 'Create Record' }}</button>
    </div>
</form>
