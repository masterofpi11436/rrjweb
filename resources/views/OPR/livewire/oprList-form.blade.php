<form wire:submit.prevent="submitForm">

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
    </div>

    <div>
        <button type="submit">{{ $oprListId ? 'Update Name' : 'Create New Name' }}</button>
    </div>
</form>
