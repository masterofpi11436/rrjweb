<div>
    <form wire:submit.prevent="submitForm">

        <div>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" wire:model.live="first_name" required>
            @error('first_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" wire:model.live="last_name" required>
            @error('last_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" wire:model.live="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="admin">Admin Access</label>
            <input type="checkbox" id="admin" wire:model.defer="admin" {{ $admin ? 'checked' : '' }}>
        </div>

        <div>
            <label for="phone">Phone Access</label>
            <input type="checkbox" id="phone" wire:model.defer="phone" {{ $phone ? 'checked' : '' }}>
        </div>

        <div>
            <button type="submit">{{ $userId ? 'Update User' : 'Create User' }}</button>
        </div>
    </form>
</div>
