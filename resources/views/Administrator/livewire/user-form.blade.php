<form wire:submit.prevent="submitForm">
    <div>
        <label for="first_name">First Name:</label>
        <input id="first_name" type="text" wire:model.live="first_name">
        @error('first_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" wire:model.live="last_name">
        @error('last_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="text" wire:model.live="email">
        @error('email') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <button type="submit">Save User</button>
    </div>
</form>
