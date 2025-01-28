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

        <h2><u>Safety Systems</u></h2>
        <table>
            <thead>
                <tr>
                    <th>Item Inspected</th>
                    <th>No Service Required</th>
                    <th>Service Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Horn</td>
                    <td>
                        <input type="checkbox"
                               id="horn_checked_no_service_required"
                               wire:model.defer="horn_checked_no_service_required"
                               {{ $horn_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('horn_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="horn_checked_service_completed"
                               wire:model.defer="horn_checked_service_completed"
                               {{ $horn_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('horn_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Seatbelts</td>
                    <td>
                        <input type="checkbox"
                               id="seatbelts_checked_no_service_required"
                               wire:model.defer="seatbelts_checked_no_service_required"
                               {{ $seatbelts_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('seatbelts_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="seatbelts_checked_service_completed"
                               wire:model.defer="seatbelts_checked_service_completed"
                               {{ $seatbelts_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('seatbelts_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Detention Equipment</td>
                    <td>
                        <input type="checkbox"
                               id="detention_equipment_checked_no_service_required"
                               wire:model.defer="detention_equipment_checked_no_service_required"
                               {{ $detention_equipment_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('detention_equipment_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="detention_equipment_checked_service_completed"
                               wire:model.defer="detention_equipment_checked_service_completed"
                               {{ $detention_equipment_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('detention_equipment_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Fire Extinguisher</td>
                    <td>
                        <input type="checkbox"
                               id="fire_extinguisher_checked_no_service_required"
                               wire:model.defer="fire_extinguisher_checked_no_service_required"
                               {{ $fire_extinguisher_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('fire_extinguisher_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="fire_extinguisher_checked_service_completed"
                               wire:model.defer="fire_extinguisher_checked_service_completed"
                               {{ $fire_extinguisher_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('fire_extinguisher_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Fire Extinguisher</td>
                    <td>
                        <input type="checkbox"
                               id="battery_booster_checked_no_service_required"
                               wire:model.defer="battery_booster_checked_no_service_required"
                               {{ $battery_booster_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('battery_booster_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="battery_booster_checked_service_completed"
                               wire:model.defer="battery_booster_checked_service_completed"
                               {{ $battery_booster_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('battery_booster_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Emergency Roadside Kit</td>
                    <td>
                        <input type="checkbox"
                               id="emergency_roadside_kit_checked_no_service_required"
                               wire:model.defer="emergency_roadside_kit_checked_no_service_required"
                               {{ $emergency_roadside_kit_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('emergency_roadside_kit_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="emergency_roadside_kit_checked_service_completed"
                               wire:model.defer="emergency_roadside_kit_checked_service_completed"
                               {{ $emergency_roadside_kit_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('emergency_roadside_kit_checked_no_service_required').checked = false;">
                    </td>
                </tr>
            </tbody>
        </table>

        <h2><u>Under the Hood</u></h2>
        <table>
            <thead>
                <tr>
                    <th>Item Inspected</th>
                    <th>No Service Required</th>
                    <th>Service Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Engine Oil</td>
                    <td>
                        <input type="checkbox"
                               id="engine_oil_checked_no_service_required"
                               wire:model.defer="engine_oil_checked_no_service_required"
                               {{ $engine_oil_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('engine_oil_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="engine_oil_checked_service_completed"
                               wire:model.defer="engine_oil_checked_service_completed"
                               {{ $engine_oil_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('engine_oil_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Coolant</td>
                    <td>
                        <input type="checkbox"
                               id="coolant_checked_no_service_required"
                               wire:model.defer="coolant_checked_no_service_required"
                               {{ $coolant_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('coolant_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="coolant_checked_service_completed"
                               wire:model.defer="coolant_checked_service_completed"
                               {{ $coolant_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('coolant_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Brake Fluid</td>
                    <td>
                        <input type="checkbox"
                               id="brake_fluid_checked_no_service_required"
                               wire:model.defer="brake_fluid_checked_no_service_required"
                               {{ $brake_fluid_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brake_fluid_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="brake_fluid_checked_service_completed"
                               wire:model.defer="brake_fluid_checked_service_completed"
                               {{ $brake_fluid_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brake_fluid_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Power Steering Fluid</td>
                    <td>
                        <input type="checkbox"
                               id="power_steering_fluid_checked_no_service_required"
                               wire:model.defer="power_steering_fluid_checked_no_service_required"
                               {{ $power_steering_fluid_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('power_steering_fluid_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="power_steering_fluid_checked_service_completed"
                               wire:model.defer="power_steering_fluid_checked_service_completed"
                               {{ $power_steering_fluid_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('power_steering_fluid_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Transmission Fluid</td>
                    <td>
                        <input type="checkbox"
                               id="transmission_fluid_checked_no_service_required"
                               wire:model.defer="transmission_fluid_checked_no_service_required"
                               {{ $transmission_fluid_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('transmission_fluid_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="transmission_fluid_checked_service_completed"
                               wire:model.defer="transmission_fluid_checked_service_completed"
                               {{ $transmission_fluid_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('transmission_fluid_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Washer Fluid</td>
                    <td>
                        <input type="checkbox"
                               id="washer_fluid_checked_no_service_required"
                               wire:model.defer="washer_fluid_checked_no_service_required"
                               {{ $washer_fluid_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('washer_fluid_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="washer_fluid_checked_service_completed"
                               wire:model.defer="washer_fluid_checked_service_completed"
                               {{ $washer_fluid_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('washer_fluid_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Air Filter</td>
                    <td>
                        <input type="checkbox"
                               id="air_filter_checked_no_service_required"
                               wire:model.defer="air_filter_checked_no_service_required"
                               {{ $air_filter_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('air_filter_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="air_filter_checked_service_completed"
                               wire:model.defer="air_filter_checked_service_completed"
                               {{ $air_filter_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('air_filter_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Belts and Hoses</td>
                    <td>
                        <input type="checkbox"
                               id="belts_and_hoses_checked_no_service_required"
                               wire:model.defer="belts_and_hoses_checked_no_service_required"
                               {{ $belts_and_hoses_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('belts_and_hoses_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="belts_and_hoses_checked_service_completed"
                               wire:model.defer="belts_and_hoses_checked_service_completed"
                               {{ $belts_and_hoses_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('belts_and_hoses_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Battery</td>
                    <td>
                        <input type="checkbox"
                               id="battery_checked_no_service_required"
                               wire:model.defer="battery_checked_no_service_required"
                               {{ $battery_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('battery_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="battery_checked_service_completed"
                               wire:model.defer="battery_checked_service_completed"
                               {{ $battery_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('battery_checked_no_service_required').checked = false;">
                    </td>
                </tr>
            </tbody>
        </table>

        <h2><u>Drivetrain</u></h2>
        <table>
            <thead>
                <tr>
                    <th>Item Inspected</th>
                    <th>No Service Required</th>
                    <th>Service Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Diagnostic Scan</td>
                    <td>
                        <input type="checkbox"
                               id="diagnostic_scan_checked_no_service_required"
                               wire:model.defer="diagnostic_scan_checked_no_service_required"
                               {{ $diagnostic_scan_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('diagnostic_scan_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="diagnostic_scan_checked_service_completed"
                               wire:model.defer="diagnostic_scan_checked_service_completed"
                               {{ $diagnostic_scan_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('diagnostic_scan_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Driveshaft/CV joints/U-joints</td>
                    <td>
                        <input type="checkbox"
                               id="driveshaft_cv_joints_u_joints_checked_no_service_required"
                               wire:model.defer="driveshaft_cv_joints_u_joints_checked_no_service_required"
                               {{ $driveshaft_cv_joints_u_joints_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('driveshaft_cv_joints_u_joints_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="driveshaft_cv_joints_u_joints_checked_service_completed"
                               wire:model.defer="driveshaft_cv_joints_u_joints_checked_service_completed"
                               {{ $driveshaft_cv_joints_u_joints_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('driveshaft_cv_joints_u_joints_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Exhaust</td>
                    <td>
                        <input type="checkbox"
                               id="exhaust_checked_no_service_required"
                               wire:model.defer="exhaust_checked_no_service_required"
                               {{ $exhaust_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('exhaust_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="exhaust_checked_service_completed"
                               wire:model.defer="exhaust_checked_service_completed"
                               {{ $exhaust_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('exhaust_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Brakes</td>
                    <td>
                        <input type="checkbox"
                               id="brakes_checked_no_service_required"
                               wire:model.defer="brakes_checked_no_service_required"
                               {{ $brakes_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brakes_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="brakes_checked_service_completed"
                               wire:model.defer="brakes_checked_service_completed"
                               {{ $brakes_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brakes_checked_no_service_required').checked = false;">
                    </td>
                </tr>
            </tbody>
        </table>

        <h2><u>Interior and Exterior</u></h2>
        <table>
            <thead>
                <tr>
                    <th>Item Inspected</th>
                    <th>No Service Required</th>
                    <th>Service Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Diagnostic Scan</td>
                    <td>
                        <input type="checkbox"
                               id="diagnostic_scan_checked_no_service_required"
                               wire:model.defer="diagnostic_scan_checked_no_service_required"
                               {{ $diagnostic_scan_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('diagnostic_scan_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="diagnostic_scan_checked_service_completed"
                               wire:model.defer="diagnostic_scan_checked_service_completed"
                               {{ $diagnostic_scan_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('diagnostic_scan_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Driveshaft/CV joints/U-joints</td>
                    <td>
                        <input type="checkbox"
                               id="driveshaft_cv_joints_u_joints_checked_no_service_required"
                               wire:model.defer="driveshaft_cv_joints_u_joints_checked_no_service_required"
                               {{ $driveshaft_cv_joints_u_joints_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('driveshaft_cv_joints_u_joints_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="driveshaft_cv_joints_u_joints_checked_service_completed"
                               wire:model.defer="driveshaft_cv_joints_u_joints_checked_service_completed"
                               {{ $driveshaft_cv_joints_u_joints_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('driveshaft_cv_joints_u_joints_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Exhaust</td>
                    <td>
                        <input type="checkbox"
                               id="exhaust_checked_no_service_required"
                               wire:model.defer="exhaust_checked_no_service_required"
                               {{ $exhaust_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('exhaust_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="exhaust_checked_service_completed"
                               wire:model.defer="exhaust_checked_service_completed"
                               {{ $exhaust_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('exhaust_checked_no_service_required').checked = false;">
                    </td>
                </tr>

                <tr>
                    <td>Brakes</td>
                    <td>
                        <input type="checkbox"
                               id="brakes_checked_no_service_required"
                               wire:model.defer="brakes_checked_no_service_required"
                               {{ $brakes_checked_no_service_required ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brakes_checked_service_completed').checked = false;">
                    </td>
                    <td>
                        <input type="checkbox"
                               id="brakes_checked_service_completed"
                               wire:model.defer="brakes_checked_service_completed"
                               {{ $brakes_checked_service_completed ? 'checked' : '' }}
                               onclick="if(this.checked) document.getElementById('brakes_checked_no_service_required').checked = false;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <label for="description_of_service">Description of Service:</label>
        <textarea id="description_of_service" wire:model.live="description_of_service"></textarea>
    </div>

    <div>
        <button type="submit">{{ $vfmId ? 'Update VFM' : 'Create VFM' }}</button>
    </div>
</form>
