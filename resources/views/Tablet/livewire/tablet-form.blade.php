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
                <label for="is_reported">Charged with 101?</label>
                <input type="checkbox" id="is_reported" wire:model.defer="is_reported" {{ $is_reported ? 'checked' : '' }}>
            </div>

            <div>
                <label for="is_filed">Filed with Inmate Accounts?</label>
                <input type="checkbox" id="is_filed" wire:model.defer="is_filed" {{ $is_filed ? 'checked' : '' }}>
            </div>

            <div>
                <label for="is_charged">Charged by Inmate Accounts?</label>
                <input type="checkbox" id="is_charged" wire:model.defer="is_charged" {{ $is_charged ? 'checked' : '' }}>
            </div>

            <div>
                <label for="is_paid">Payment Status?</label>
                <input type="checkbox" id="is_paid" wire:model.defer="is_paid" {{ $is_paid ? 'checked' : '' }}>
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
