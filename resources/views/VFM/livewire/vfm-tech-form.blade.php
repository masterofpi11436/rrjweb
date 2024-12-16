<form wire:submit.prevent="submitForm">
    <div>
        <label for="date_in">Date In:</label>
        <input id="date_in" type="date" wire:model.defer="date_in">
        @error('date_in') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="date_out">Date Out:</label>
        <input id="date_out" type="date" wire:model.defer="date_out">
        @error('date_out') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="state_inspection">State Inspection</label>
        <input id="state_inspection" type="date" wire:model.defer="state_inspection">
        @error('state_inspection') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="license_plate">License Plate:</label>
        <input id="license_plate" type="text" wire:model.live="license_plate">
        @error('license_plate') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="mileage">Mileage:</label>
        <input id="mileage" type="number" wire:model.live="mileage">
        @error('mileage') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="vehicle_year">vehicle_year:</label>
        <input id="vehicle_year" type="number" wire:model.live="vehicle_year">
        @error('vehicle_year') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="make">Make:</label>
        <input id="make" type="text" wire:model.live="make">
        @error('make') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="model">Model:</label>
        <input id="model" type="text" wire:model.live="model">
        @error('model') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="vin">VIN:</label>
        <input id="vin" type="text" wire:model.live="vin">
        @error('vin') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="air_filter">Air Filter:</label>
        <input type="checkbox" id="air_filter" wire:model.defer="air_filter" {{ $air_filter ? 'checked' : '' }}>
    </div>

    <div>
        <label for="antifreeze">antifreeze:</label>
        <input type="checkbox" id="antifreeze" wire:model.defer="antifreeze" {{ $antifreeze ? 'checked' : '' }}>
    </div>

    <div>
        <label for="battery">battery:</label>
        <input type="checkbox" id="battery" wire:model.defer="battery" {{ $battery ? 'checked' : '' }}>
    </div>

    <div>
        <label for="battery_booster">battery_booster:</label>
        <input type="checkbox" id="battery_booster" wire:model.defer="battery_booster" {{ $battery_booster ? 'checked' : '' }}>
    </div>

    <div>
        <label for="belts">belts:</label>
        <input type="checkbox" id="belts" wire:model.defer="belts" {{ $belts ? 'checked' : '' }}>
    </div>

    <div>
        <label for="brake_fluid">brake_fluid:</label>
        <input type="checkbox" id="brake_fluid" wire:model.defer="brake_fluid" {{ $brake_fluid ? 'checked' : '' }}>
    </div>

    <div>
        <label for="brakes_front">brakes_front:</label>
        <input type="checkbox" id="brakes_front" wire:model.defer="brakes_front" {{ $brakes_front ? 'checked' : '' }}>
    </div>

    <div>
        <label for="brakes_rear">brakes_rear:</label>
        <input type="checkbox" id="brakes_rear" wire:model.defer="brakes_rear" {{ $brakes_rear ? 'checked' : '' }}>
    </div>

    <div>
        <label for="detention_equipment">detention_equipment:</label>
        <input type="checkbox" id="detention_equipment" wire:model.defer="detention_equipment" {{ $detention_equipment ? 'checked' : '' }}>
    </div>

    <div>
        <label for="diagnostic_scan">diagnostic_scan:</label>
        <input type="checkbox" id="diagnostic_scan" wire:model.defer="diagnostic_scan" {{ $diagnostic_scan ? 'checked' : '' }}>
    </div>

    <div>
        <label for="engine_oil">engine_oil:</label>
        <input type="checkbox" id="engine_oil" wire:model.defer="engine_oil" {{ $engine_oil ? 'checked' : '' }}>
    </div>

    <div>
        <label for="exhaust">exhaust:</label>
        <input type="checkbox" id="exhaust" wire:model.defer="exhaust" {{ $exhaust ? 'checked' : '' }}>
    </div>

    <div>
        <label for="hoses">hoses:</label>
        <input type="checkbox" id="hoses" wire:model.defer="hoses" {{ $hoses ? 'checked' : '' }}>
    </div>

    <div>
        <label for="lights">lights:</label>
        <input type="checkbox" id="lights" wire:model.defer="lights" {{ $lights ? 'checked' : '' }}>
    </div>

    <div>
        <label for="mirrors">mirrors:</label>
        <input type="checkbox" id="mirrors" wire:model.defer="mirrors" {{ $mirrors ? 'checked' : '' }}>
    </div>

    <div>
        <label for="power_steering_fluid">power_steering_fluid:</label>
        <input type="checkbox" id="power_steering_fluid" wire:model.defer="power_steering_fluid" {{ $power_steering_fluid ? 'checked' : '' }}>
    </div>

    <div>
        <label for="safety_restraints">safety_restraints:</label>
        <input type="checkbox" id="safety_restraints" wire:model.defer="safety_restraints" {{ $safety_restraints ? 'checked' : '' }}>
    </div>

    <div>
        <label for="shocks_struts">shocks_struts:</label>
        <input type="checkbox" id="shocks_struts" wire:model.defer="shocks_struts" {{ $shocks_struts ? 'checked' : '' }}>
    </div>

    <div>
        <label for="tires">tires:</label>
        <input type="checkbox" id="tires" wire:model.defer="tires" {{ $tires ? 'checked' : '' }}>
    </div>

    <div>
        <label for="transmission_fluid">transmission_fluid:</label>
        <input type="checkbox" id="transmission_fluid" wire:model.defer="transmission_fluid" {{ $transmission_fluid ? 'checked' : '' }}>
    </div>

    <div>
        <label for="washer_fluid">washer_fluid:</label>
        <input type="checkbox" id="washer_fluid" wire:model.defer="washer_fluid" {{ $washer_fluid ? 'checked' : '' }}>
    </div>

    <div>
        <label for="window_operation">window_operation:</label>
        <input type="checkbox" id="window_operation" wire:model.defer="window_operation" {{ $window_operation ? 'checked' : '' }}>
    </div>

    <div>
        <label for="windshield">windshield:</label>
        <input type="checkbox" id="windshield" wire:model.defer="windshield" {{ $windshield ? 'checked' : '' }}>
    </div>

    <div>
        <label for="wiper_blades">wiper_blades:</label>
        <input type="checkbox" id="wiper_blades" wire:model.defer="wiper_blades" {{ $wiper_blades ? 'checked' : '' }}>
    </div>

    <div>
        <label for="fire_extinguisher">fire_extinguisher:</label>
        <input type="checkbox" id="fire_extinguisher" wire:model.defer="fire_extinguisher" {{ $fire_extinguisher ? 'checked' : '' }}>
    </div>

    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea id="description_of_service" wire:model.live="description_of_service"></textarea>
    </div>

    <div>
        <button type="submit">Create VFM</button>
    </div>
</form>
