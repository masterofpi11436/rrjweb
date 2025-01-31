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
        <h3>30 Point Inspection</h3>
        <fieldset>
            <legend>Safety Systems</legend>
            <table>
                <tr>
                    <th>Insepcted Item</th>
                    <th>Service Required</th>
                </tr>
                <tr>
                    <td><label for="horn">Horn</label></td>
                    <td><input type="checkbox" id="horn" wire:model.defer="horn" {{ $horn ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="seatbelts">Seatbelts</label></td>
                    <td><input type="checkbox" id="seatbelts" wire:model.defer="seatbelts" {{ $seatbelts ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="detention_equipment">Detention Equipment</label></td>
                    <td><input type="checkbox" id="detention_equipment" wire:model.defer="detention_equipment" {{ $detention_equipment ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="fire_extinguisher">Fire Extinguisher</label></td>
                    <td><input type="checkbox" id="fire_extinguisher" wire:model.defer="fire_extinguisher" {{ $fire_extinguisher ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="battery_booster">battery_booster</label></td>
                    <td><input type="checkbox" id="battery_booster" wire:model.defer="battery_booster" {{ $battery_booster ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="emergency_roadside_kit">emergency_roadside_kit</label></td>
                    <td><input type="checkbox" id="emergency_roadside_kit" wire:model.defer="emergency_roadside_kit" {{ $emergency_roadside_kit ? 'checked' : '' }}></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Under the Hood</legend>
            <table>
                <tr>
                    <th>Insepcted Item</th>
                    <th>Service Required</th>
                </tr>
                <tr>
                    <td><label for="engine_oil">engine_oil</label></td>
                    <td><input type="checkbox" id="engine_oil" wire:model.defer="engine_oil" {{ $engine_oil ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="coolant">coolant</label></td>
                    <td><input type="checkbox" id="coolant" wire:model.defer="coolant" {{ $coolant ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="brake_fluid">brake_fluid</label></td>
                    <td><input type="checkbox" id="detention_equipment" wire:model.defer="detention_equipment" {{ $detention_equipment ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="brake_fluid">brake_fluid</label></td>
                    <td><input type="checkbox" id="brake_fluid" wire:model.defer="brake_fluid" {{ $brake_fluid ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="power_steering_fluid">power_steering_fluid</label></td>
                    <td><input type="checkbox" id="power_steering_fluid" wire:model.defer="power_steering_fluid" {{ $power_steering_fluid ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="transmission_fluid">transmission_fluid</label></td>
                    <td><input type="checkbox" id="transmission_fluid" wire:model.defer="transmission_fluid" {{ $transmission_fluid ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="washer_fluid">washer_fluid</label></td>
                    <td><input type="checkbox" id="washer_fluid" wire:model.defer="washer_fluid" {{ $washer_fluid ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="air_filter">air_filter</label></td>
                    <td><input type="checkbox" id="air_filter" wire:model.defer="air_filter" {{ $air_filter ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="belts_and_hoses">belts_and_hoses</label></td>
                    <td><input type="checkbox" id="belts_and_hoses" wire:model.defer="belts_and_hoses" {{ $belts_and_hoses ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="battery">battery</label></td>
                    <td><input type="checkbox" id="battery" wire:model.defer="battery" {{ $battery ? 'checked' : '' }}></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Drivetrain</legend>
            <table>
                <tr>
                    <th>Insepcted Item</th>
                    <th>Service Required</th>
                </tr>
                <tr>
                    <td><label for="diagnostic_scan">diagnostic_scan</label></td>
                    <td><input type="checkbox" id="diagnostic_scan" wire:model.defer="diagnostic_scan" {{ $diagnostic_scan ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="driveshaft_cv_joints_u_joints">driveshaft_cv_joints_u_joints</label></td>
                    <td><input type="checkbox" id="driveshaft_cv_joints_u_joints" wire:model.defer="driveshaft_cv_joints_u_joints" {{ $driveshaft_cv_joints_u_joints ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="exhaust">exhaust</label></td>
                    <td><input type="checkbox" id="exhaust" wire:model.defer="exhaust" {{ $exhaust ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="brakes">brakes</label></td>
                    <td><input type="checkbox" id="brakes" wire:model.defer="brakes" {{ $brakes ? 'checked' : '' }}></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Interior and Exterior</legend>
            <table>
                <tr>
                    <td><label for="body_and_paint">body_and_paint</label></td>
                    <td><input type="checkbox" id="body_and_paint" wire:model.defer="body_and_paint" {{ $body_and_paint ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="lights">lights</label></td>
                    <td><input type="checkbox" id="lights" wire:model.defer="lights" {{ $lights ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="a_c_systems">a_c_systems</label></td>
                    <td><input type="checkbox" id="a_c_systems" wire:model.defer="a_c_systems" {{ $a_c_systems ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="windshield_wipers">windshield_wipers</label></td>
                    <td><input type="checkbox" id="windshield_wipers" wire:model.defer="windshield_wipers" {{ $windshield_wipers ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="windshield">windshield</label></td>
                    <td><input type="checkbox" id="windshield" wire:model.defer="windshield" {{ $windshield ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="window_operation">window_operation</label></td>
                    <td><input type="checkbox" id="window_operation" wire:model.defer="window_operation" {{ $window_operation ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="mirrors">mirrors</label></td>
                    <td><input type="checkbox" id="mirrors" wire:model.defer="mirrors" {{ $mirrors ? 'checked' : '' }}></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Suspension</legend>
            <table>
                <tr>
                    <td><label for="tires">tires</label></td>
                    <td><input type="checkbox" id="tires" wire:model.defer="tires" {{ $tires ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="tire_air_pressure">tire_air_pressure</label></td>
                    <td><input type="checkbox" id="tire_air_pressure" wire:model.defer="tire_air_pressure" {{ $tire_air_pressure ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="shock_Struts">shock_Struts</label></td>
                    <td><input type="checkbox" id="shock_Struts" wire:model.defer="shock_Struts" {{ $shock_Struts ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td><label for="ball_joints_and_bushings">ball_joints_and_bushings</label></td>
                    <td><input type="checkbox" id="ball_joints_and_bushings" wire:model.defer="ball_joints_and_bushings" {{ $ball_joints_and_bushings ? 'checked' : '' }}></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea id="description_of_service" wire:model.live="description_of_service"></textarea>
    </div>

    <div>
        <button type="submit">{{ $vfmId ? 'Update VFM' : 'Create VFM' }}</button>
    </div>
</form>
