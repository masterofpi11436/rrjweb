<?php

namespace Database\Factories\VFM;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VFM30Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-5 years', 'now');

        return [
            'date_in' => $this->faker->date(),
            'date_out' => $this->faker->date(),
            'state_inspection' => $this->faker->date(),
            'license_plate' => strtoupper($this->faker->bothify('???###')),
            'mileage' => $this->faker->numberBetween(10000, 200000),
            'vehicle_year' => $this->faker->year(),
            'make' => $this->faker->company(),
            'model' => $this->faker->word(),
            'vin' => strtoupper($this->faker->bothify('1HGCM82633A######')),

            // Booleans for checks and services
            'horn_checked_no_service_required' => $this->faker->boolean(),
            'horn_checked_service_completed' => $this->faker->boolean(),
            'seatbelts_checked_no_service_required' => $this->faker->boolean(),
            'seatbelts_checked_service_completed' => $this->faker->boolean(),
            'detention_equipment_checked_no_service_required' => $this->faker->boolean(),
            'detention_equipment_checked_service_completed' => $this->faker->boolean(),
            'fire_extinguisher_checked_no_service_required' => $this->faker->boolean(),
            'fire_extinguisher_checked_service_completed' => $this->faker->boolean(),
            'battery_booster_checked_no_service_required' => $this->faker->boolean(),
            'battery_booster_checked_service_completed' => $this->faker->boolean(),
            'emergency_roadside_kit_checked_no_service_required' => $this->faker->boolean(),
            'emergency_roadside_kit_checked_service_completed' => $this->faker->boolean(),

            'engine_oil_checked_no_service_required' => $this->faker->boolean(),
            'engine_oil_checked_service_completed' => $this->faker->boolean(),
            'coolant_checked_no_service_required' => $this->faker->boolean(),
            'coolant_checked_service_completed' => $this->faker->boolean(),
            'brake_fluid_checked_no_service_required' => $this->faker->boolean(),
            'brake_fluid_checked_service_completed' => $this->faker->boolean(),
            'power_steering_fluid_checked_no_service_required' => $this->faker->boolean(),
            'power_steering_fluid_checked_service_completed' => $this->faker->boolean(),
            'transmission_fluid_checked_no_service_required' => $this->faker->boolean(),
            'transmission_fluid_checked_service_completed' => $this->faker->boolean(),
            'washer_fluid_checked_no_service_required' => $this->faker->boolean(),
            'washer_fluid_checked_service_completed' => $this->faker->boolean(),
            'air_filter_checked_no_service_required' => $this->faker->boolean(),
            'air_filter_checked_service_completed' => $this->faker->boolean(),
            'belts_and_hoses_checked_no_service_required' => $this->faker->boolean(),
            'belts_and_hoses_checked_service_completed' => $this->faker->boolean(),
            'battery_checked_no_service_required' => $this->faker->boolean(),
            'battery_checked_service_completed' => $this->faker->boolean(),

            'diagnostic_scan_checked_no_service_required' => $this->faker->boolean(),
            'diagnostic_scan_checked_service_completed' => $this->faker->boolean(),
            'driveshaft_cv_joints_u_joints_checked_no_service_required' => $this->faker->boolean(),
            'driveshaft_cv_joints_u_joints_checked_service_completed' => $this->faker->boolean(),
            'exhaust_checked_no_service_required' => $this->faker->boolean(),
            'exhaust_checked_service_completed' => $this->faker->boolean(),
            'brakes_checked_no_service_required' => $this->faker->boolean(),
            'brakes_checked_service_completed' => $this->faker->boolean(),

            'body_and_paint_checked_no_service_required' => $this->faker->boolean(),
            'body_and_paint_checked_service_completed' => $this->faker->boolean(),
            'lights_checked_no_service_required' => $this->faker->boolean(),
            'lights_checked_service_completed' => $this->faker->boolean(),
            'ac_systems_checked_no_service_required' => $this->faker->boolean(),
            'ac_systems_checked_service_completed' => $this->faker->boolean(),
            'windshield_wipers_checked_no_service_required' => $this->faker->boolean(),
            'windshield_wipers_checked_service_completed' => $this->faker->boolean(),
            'windshield_checked_no_service_required' => $this->faker->boolean(),
            'windshield_checked_service_completed' => $this->faker->boolean(),
            'window_operation_checked_no_service_required' => $this->faker->boolean(),
            'window_operation_checked_service_completed' => $this->faker->boolean(),
            'mirrors_checked_no_service_required' => $this->faker->boolean(),
            'mirrors_checked_service_completed' => $this->faker->boolean(),

            'tires_checked_no_service_required' => $this->faker->boolean(),
            'tires_checked_service_completed' => $this->faker->boolean(),
            'tire_air_pressure_checked_no_service_required' => $this->faker->boolean(),
            'tire_air_pressure_checked_service_completed' => $this->faker->boolean(),
            'shocks_struts_checked_no_service_required' => $this->faker->boolean(),
            'shocks_struts_checked_service_completed' => $this->faker->boolean(),
            'ball_joints_and_bushings_checked_no_service_required' => $this->faker->boolean(),
            'ball_joints_and_bushings_checked_service_completed' => $this->faker->boolean(),

            'description_of_service' => $this->faker->optional()->sentence(),
            'is_outside_service_required' => $this->faker->boolean(),
            'outside_service_required' => $this->faker->word(),
            'outside_service_po' => strtoupper($this->faker->bothify('PO-#####')),
            'maintenance_technician' => $this->faker->name(),

        ];
    }
}
