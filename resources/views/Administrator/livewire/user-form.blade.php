<div>
    <form wire:submit.prevent="saveUser">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" wire:model="first_name" class="form-control">
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" wire:model="last_name" class="form-control">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" wire:model="role" class="form-control">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="application">Application</label>
            <select id="application" wire:model="application" class="form-control">
                <option value="">Select Application</option>
                @foreach ($applications as $application)
                    <option value="{{ $application->id }}">{{ $application->name }}</option>
                @endforeach
            </select>
            @error('application') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $userId ? 'Update User' : 'Create User' }}
        </button>
    </form>
</div>
