<form class="form" wire:submit.prevent="submitForm">

    <div class="vehicle-info">
        <h3>Vehicle Information</h3>
        <div class="grid-container">
            <div>
                <label for="license_plate">License Plate:</label>
                <input id="license_plate" type="text" wire:model.live="license_plate">
                @error('license_plate') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="vehicle_year">Vehicle Year:</label>
                <input id="vehicle_year" type="number" wire:model.live="vehicle_year">
                @error('vehicle_year') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="make">Make:</label>
                <input id="make" type="text" wire:model.live="make">
                @error('make') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="model">Model:</label>
                <input id="model" type="text" wire:model.live="model">
                @error('model') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="vin">VIN:</label>
                <input id="vin" type="text" wire:model.live="vin">
                @error('vin') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit">{{ $vfmVehicleId ? 'Update' : 'Create' }}</button>
    </div>

</form>

