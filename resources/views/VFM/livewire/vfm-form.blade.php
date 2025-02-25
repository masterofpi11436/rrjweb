<form class="form" wire:submit.prevent="submitForm">

    <!-- Vehicle Information Section -->
    <div class="vehicle-info">
        <h3>Vehicle Information</h3>
        <div class="grid-container">
            <div>
                <label for="date_in">Date In:</label>
                <input id="date_in" type="date" wire:model.defer="date_in">
                @error('date_in') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date_out">Date Out:</label>
                <input id="date_out" type="date" wire:model.defer="date_out">
                @error('date_out') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="state_inspection">State Inspection</label>
                <input id="state_inspection" type="date" wire:model.defer="state_inspection">
                @error('state_inspection') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="license_plate">License Plate:</label>
                <input id="license_plate" type="text" wire:model.live="license_plate">
                @error('license_plate') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="mileage">Mileage:</label>
                <input id="mileage" type="number" wire:model.live="mileage">
                @error('mileage') <span class="error">{{ $message }}</span> @enderror
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

    <!-- 25 Point Inspection Section -->
    <div class="inspection">
        <h3>25 Point Inspection</h3>
        <div class="grid-container">
            @php
                $inspectionItems = [
                    'air_filter' => 'Air Filter',
                    'antifreeze' => 'Antifreeze',
                    'battery' => 'Battery',
                    'battery_booster' => 'Battery Booster',
                    'belts' => 'Belts',
                    'brake_fluid' => 'Brake Fluid',
                    'brakes_front' => 'Brakes Front',
                    'brakes_rear' => 'Brakes Rear',
                    'detention_equipment' => 'Detention Equipment',
                    'diagnostic_scan' => 'Diagnostic Scan',
                    'engine_oil' => 'Engine Oil',
                    'exhaust' => 'Exhaust',
                    'hoses' => 'Hoses',
                    'lights' => 'Lights',
                    'mirrors' => 'Mirrors',
                    'power_steering_fluid' => 'Power Steering Fluid',
                    'safety_restraints' => 'Safety Restraints',
                    'shocks_struts' => 'Shock/Struts',
                    'tires' => 'Tires',
                    'transmission_fluid' => 'Transmission Fluid',
                    'vehicle_jump_starter' => 'Vehicle Jump Starter',
                    'washer_fluid' => 'Washer Fluid',
                    'window_operation' => 'Window Operation',
                    'windshield' => 'Windshield',
                    'wiper_blades' => 'Wiper Blades',
                    'fire_extinguisher' => 'Fire Extinguisher'
                ];
            @endphp

            @foreach ($inspectionItems as $field => $label)
                <div class="checkbox-item">
                    <input type="checkbox" id="{{ $field }}" wire:model.defer="{{ $field }}" {{ ${$field} ? 'checked' : '' }}>
                    <label for="{{ $field }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Description of Service -->
    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea class="grid-container" id="description_of_service" wire:model.live="description_of_service"></textarea>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit">{{ $vfmId ? 'Update VFM' : 'Create VFM' }}</button>
    </div>

</form>

