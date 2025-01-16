<form wire:submit.prevent="submitForm">

    <div class="vehicle-info">
        <h3>Vehicle Information</h3>
        <div class="field">
            <div>
                <label for="date_in">Date In:</label>
                <input id="date_in" type="date" wire:model.defer="date_in">
                @error('date_in') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date_out">Date Out:</label>
                <input id="date_out" type="date" wire:model.defer="date_out">
                @error('date_out') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="state_inspection">State Inspection</label>
                <input id="state_inspection" type="date" wire:model.defer="state_inspection">
                @error('state_inspection') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="license_plate">License Plate:</label>
                <input id="license_plate" type="text" wire:model.live="license_plate">
                @error('license_plate') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="mileage">Mileage:</label>
                <input id="mileage" type="number" wire:model.live="mileage">
                @error('mileage') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="vehicle_year">Vehicle Year:</label>
                <input id="vehicle_year" type="number" wire:model.live="vehicle_year">
                @error('vehicle_year') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="make">Make:</label>
                <input id="make" type="text" wire:model.live="make">
                @error('make') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="model">Model:</label>
                <input id="model" type="text" wire:model.live="model">
                @error('model') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="vin">VIN:</label>
                <input id="vin" type="text" wire:model.live="vin">
                @error('vin') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="inspection">
        <h3>25 Point Inspection</h3>
        <div class="checkboxes">
            <div>
                <label for="air_filter">Air Filter:</label>
                <input type="checkbox" id="air_filter" wire:model.defer="air_filter" {{ $air_filter ? 'checked' : '' }}>
            </div>

            <div>
                <label for="antifreeze">Antifreeze:</label>
                <input type="checkbox" id="antifreeze" wire:model.defer="antifreeze" {{ $antifreeze ? 'checked' : '' }}>
            </div>

            <div>
                <label for="battery">Battery:</label>
                <input type="checkbox" id="battery" wire:model.defer="battery" {{ $battery ? 'checked' : '' }}>
            </div>

            <div>
                <label for="battery_booster">Battery Booster:</label>
                <input type="checkbox" id="battery_booster" wire:model.defer="battery_booster" {{ $battery_booster ? 'checked' : '' }}>
            </div>

            <div>
                <label for="belts">Belts:</label>
                <input type="checkbox" id="belts" wire:model.defer="belts" {{ $belts ? 'checked' : '' }}>
            </div>

            <div>
                <label for="brake_fluid">Brake Fluid:</label>
                <input type="checkbox" id="brake_fluid" wire:model.defer="brake_fluid" {{ $brake_fluid ? 'checked' : '' }}>
            </div>

            <div>
                <label for="brakes_front">Brakes Front:</label>
                <input type="checkbox" id="brakes_front" wire:model.defer="brakes_front" {{ $brakes_front ? 'checked' : '' }}>
            </div>

            <div>
                <label for="brakes_rear">Brakes Rear:</label>
                <input type="checkbox" id="brakes_rear" wire:model.defer="brakes_rear" {{ $brakes_rear ? 'checked' : '' }}>
            </div>

            <div>
                <label for="detention_equipment">Detention Equipment:</label>
                <input type="checkbox" id="detention_equipment" wire:model.defer="detention_equipment" {{ $detention_equipment ? 'checked' : '' }}>
            </div>

            <div>
                <label for="diagnostic_scan">Diagnostic Scan:</label>
                <input type="checkbox" id="diagnostic_scan" wire:model.defer="diagnostic_scan" {{ $diagnostic_scan ? 'checked' : '' }}>
            </div>

            <div>
                <label for="engine_oil">Engine Oil:</label>
                <input type="checkbox" id="engine_oil" wire:model.defer="engine_oil" {{ $engine_oil ? 'checked' : '' }}>
            </div>

            <div>
                <label for="exhaust">Exhaust:</label>
                <input type="checkbox" id="exhaust" wire:model.defer="exhaust" {{ $exhaust ? 'checked' : '' }}>
            </div>

            <div>
                <label for="hoses">Hoses:</label>
                <input type="checkbox" id="hoses" wire:model.defer="hoses" {{ $hoses ? 'checked' : '' }}>
            </div>

            <div>
                <label for="lights">Lights:</label>
                <input type="checkbox" id="lights" wire:model.defer="lights" {{ $lights ? 'checked' : '' }}>
            </div>

            <div>
                <label for="mirrors">Mirrors:</label>
                <input type="checkbox" id="mirrors" wire:model.defer="mirrors" {{ $mirrors ? 'checked' : '' }}>
            </div>

            <div>
                <label for="power_steering_fluid">Power Steering Fluid:</label>
                <input type="checkbox" id="power_steering_fluid" wire:model.defer="power_steering_fluid" {{ $power_steering_fluid ? 'checked' : '' }}>
            </div>

            <div>
                <label for="safety_restraints">Safety Restraints:</label>
                <input type="checkbox" id="safety_restraints" wire:model.defer="safety_restraints" {{ $safety_restraints ? 'checked' : '' }}>
            </div>

            <div>
                <label for="shocks_struts">Shock/Struts:</label>
                <input type="checkbox" id="shocks_struts" wire:model.defer="shocks_struts" {{ $shocks_struts ? 'checked' : '' }}>
            </div>

            <div>
                <label for="tires">Tires:</label>
                <input type="checkbox" id="tires" wire:model.defer="tires" {{ $tires ? 'checked' : '' }}>
            </div>

            <div>
                <label for="transmission_fluid">Transmission Fluid:</label>
                <input type="checkbox" id="transmission_fluid" wire:model.defer="transmission_fluid" {{ $transmission_fluid ? 'checked' : '' }}>
            </div>

            <div>
                <label for="vehicle_jump_starter">Vehicle Jump Starter:</label>
                <input type="checkbox" id="vehicle_jump_starter" wire:model.defer="vehicle_jump_starter" {{ $vehicle_jump_starter ? 'checked' : '' }}>
            </div>

            <div>
                <label for="washer_fluid">Washer Fluid:</label>
                <input type="checkbox" id="washer_fluid" wire:model.defer="washer_fluid" {{ $washer_fluid ? 'checked' : '' }}>
            </div>

            <div>
                <label for="window_operation">Window Operation:</label>
                <input type="checkbox" id="window_operation" wire:model.defer="window_operation" {{ $window_operation ? 'checked' : '' }}>
            </div>

            <div>
                <label for="windshield">Windshield:</label>
                <input type="checkbox" id="windshield" wire:model.defer="windshield" {{ $windshield ? 'checked' : '' }}>
            </div>

            <div>
                <label for="wiper_blades">Wiper Blades:</label>
                <input type="checkbox" id="wiper_blades" wire:model.defer="wiper_blades" {{ $wiper_blades ? 'checked' : '' }}>
            </div>

            <div>
                <label for="fire_extinguisher">Fire Extinguisher:</label>
                <input type="checkbox" id="fire_extinguisher" wire:model.defer="fire_extinguisher" {{ $fire_extinguisher ? 'checked' : '' }}>
            </div>
        </div>
    </div>

    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea id="description_of_service" wire:model.live="description_of_service"></textarea>
    </div>

    <div>
        <button type="submit">{{ $vfmId ? 'Update VFM' : 'Create VFM' }}</button>
    </div>
</form>
