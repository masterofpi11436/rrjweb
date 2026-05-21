<form wire:submit.prevent="submitForm">

    <div>
        <label for="camera_number">Camera Number</label>
        <input id="camera_number" type="text" wire:model.live="camera_number">
        @error('camera_number') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="camera_name">Camera Name</label>
        <input id="camera_name" type="text" wire:model.live="camera_name">
        @error('camera_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="camera_type">Camera Type</label>
        <select id="camera_type" wire:model.live="camera_type">
            <option value="">Select Type</option>
            <option value="analog">Analog</option>
            <option value="digital">Digital</option>
        </select>

        @error('camera_type') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="location">Location</label>
        <input id="location" type="text" wire:model.live="location">
        @error('location') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="status">Status</label>
        <select id="status" wire:model.live="status">
            <option value="">Select Status</option>
            <option value="good">Good</option>
            <option value="no_video">No Video</option>
            <option value="blurry">Blurry</option>
            <option value="iris">Iris</option>
            <option value="adjust">Adjust</option>
            <option value="clean">Clean</option>
            <option value="pending_digital_upgrade">Pending Digital Upgrade</option>
        </select>

        @error('status') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="encoder_switch_location">
            Encoder / Switch Location
        </label>

        <input
            id="encoder_switch_location"
            type="text"
            wire:model.live="encoder_switch_location"
        >

        @error('encoder_switch_location')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="ip_address">IP Address</label>
        <input id="ip_address" type="text" wire:model.live="ip_address">

        @error('ip_address')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">
            {{ $cameraId ? 'Update Camera' : 'Create Camera' }}
        </button>
    </div>

</form>
