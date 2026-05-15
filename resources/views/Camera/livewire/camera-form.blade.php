<form wire:submit.prevent="submitForm">
    <div>
        <label for="name">Name:</label>
        <input id="name" type="text" wire:model.live="name">
        @error('name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="title">Title</label>
        <input id="title" type="text" wire:model.live="title">
        @error('title') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="section">Section</label>
        <input id="section" type="text" wire:model.live="section">
        @error('section') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="extension">Extension</label>
        <input id="extension" type="text" wire:model.live="extension">
        @error('extension') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <button type="submit">{{ $phoneDirectoryId ? 'Update Extension' : 'Create Extension' }}</button>
    </div>
</form>
