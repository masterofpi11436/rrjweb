<div>
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- User Form -->
    <form wire:submit.prevent="submitForm">
        <!-- First Name -->
        <div>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" wire:model.defer="first_name" required>
            @error('first_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" wire:model.defer="last_name" required>
            @error('last_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" wire:model.defer="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Admin Access -->
        <div>
            <label for="admin">Admin Access</label>
            <input type="checkbox" id="admin" wire:model.defer="admin" {{ $admin ? 'checked' : '' }}>
        </div>

        <!-- Phone Access -->
        <div>
            <label for="phone">Phone Access</label>
            <input type="checkbox" id="phone" wire:model.defer="phone" {{ $phone ? 'checked' : '' }}>
        </div>

        <!-- Tablet Access -->
        <div>
            <label for="tablet">Tablet Access</label>
            <input type="checkbox" id="tablet" wire:model.defer="tablet" {{ $tablet ? 'checked' : '' }}>
        </div>

        <div>
            <button type="submit">{{ $userId ? 'Update User' : 'Create User' }}</button>
        </div>
    </form>
</div>
