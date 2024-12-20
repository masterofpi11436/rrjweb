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
            <label for="admin">Admin</label>
            <input type="checkbox" id="admin" wire:model.defer="admin" {{ $admin ? 'checked' : '' }}>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="checkbox" id="phone" wire:model.defer="phone" {{ $phone ? 'checked' : '' }}>
        </div>

        <div>
            <label for="vfm">VFM Admin</label>
            <input type="checkbox" id="vfm" wire:model.defer="vfm" {{ $vfm ? 'checked' : '' }}>
        </div>

        <div>
            <label for="vfm_tech">VFM Tech</label>
            <input type="checkbox" id="vfm_tech" wire:model.defer="vfm_tech" {{ $vfm_tech ? 'checked' : '' }}>
        </div>

        <div>
            <label for="ics">ICS</label>
            <input type="checkbox" id="ics" wire:model.defer="ics" {{ $ics ? 'checked' : '' }}>
        </div>

        <div>
            <button type="submit">{{ $userId ? 'Update User' : 'Create User' }}</button>
        </div>

        @if ($userId)
            <div>
                <button type="button" wire:click="sendResetEmail">
                    Reset Password
                </button>
            </div>
        @endif

    </form>
</div>
