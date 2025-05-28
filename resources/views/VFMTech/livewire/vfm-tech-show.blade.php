<form class="form" wire:submit.prevent="submitForm">

    <!-- Vehicle Information Section -->
    <div class="vehicle-info">
        <h3>Vehicle Information</h3>
        <div class="grid-container">
            <div>
                <label for="vfm_vehicle_id">Select Vehicle:</label>
                <select id="vfm_vehicle_id" wire:model.defer="vfm_vehicle_id" wire:change="$refresh" disabled>
                    <option value="">-- Select a vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->license_plate }}
                        </option>
                    @endforeach
                </select>
                @error('vfm_vehicle_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Make:</label>
                <input type="text" wire:model.defer="make" disabled>
            </div>

            <div>
                <label>Model:</label>
                <input type="text" wire:model.defer="model" disabled>
            </div>

            <div>
                <label>VIN:</label>
                <input type="text" wire:model.defer="vin" disabled>
            </div>

            <div>
                <label>Year</label>
                <input type="text" wire:model.defer="vehicle_year" disabled>
            </div>

            <div>
                <label>License Plate:</label>
                <input type="text" wire:model.defer="license_plate" disabled>
            </div>

            <div>
                <label for="date_in">Date In:</label>
                <input id="date_in" type="date" wire:model.defer="date_in" disabled>
            </div>

            <div>
                <label for="date_out">Date Out:</label>
                <input id="date_out" type="date" wire:model.defer="date_out" disabled>
            </div>

            <div>
                <label for="state_inspection">State Inspection</label>
                <input id="state_inspection" type="date" wire:model.defer="state_inspection" disabled>
            </div>

            <div>
                <label for="mileage">Mileage:</label>
                <input id="mileage" type="number" wire:model.defer="mileage" disabled>
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
                    <input type="checkbox" id="{{ $field }}" wire:model.defer="{{ $field }}" {{ ${$field} ? 'checked' : '' }} disabled>
                    <label for="{{ $field }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Description of Service -->
    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea class="grid-container" id="description_of_service" wire:model.defer="description_of_service" disabled></textarea>
    </div>

</form>

