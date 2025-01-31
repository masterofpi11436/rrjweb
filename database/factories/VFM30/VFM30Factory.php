<?php

namespace Database\Factories\VFM30;

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

            // Safety Systems
            'horn' => $this->faker->boolean(),
            'seatbelts' => $this->faker->boolean(),
            'detention_equipment' => $this->faker->boolean(),
            'fire_extinguisher' => $this->faker->boolean(),
            'battery_booster' => $this->faker->boolean(),
            'emergency_roadside_kit' => $this->faker->boolean(),

            // Under the Hood
            'engine_oil' => $this->faker->boolean(),
            'coolant' => $this->faker->boolean(),
            'brake_fluid' => $this->faker->boolean(),
            'power_steering_fluid' => $this->faker->boolean(),
            'transmission_fluid' => $this->faker->boolean(),
            'washer_fluid' => $this->faker->boolean(),
            'air_filter' => $this->faker->boolean(),
            'belts_and_hoses' => $this->faker->boolean(),
            'battery' => $this->faker->boolean(),

            // Drivetrain
            'diagnostic_scan' => $this->faker->boolean(),
            'driveshaft_cv_joints_u_joints' => $this->faker->boolean(),
            'exhaust' => $this->faker->boolean(),
            'brakes' => $this->faker->boolean(),

            // Interior and Exterior
            'body_and_paint' => $this->faker->boolean(),
            'lights' => $this->faker->boolean(),
            'a_c_systems' => $this->faker->boolean(),
            'windshield_wipers' => $this->faker->boolean(),
            'windshield' => $this->faker->boolean(),
            'window_operation' => $this->faker->boolean(),
            'mirrors' => $this->faker->boolean(),

            // Suspension
            'tires' => $this->faker->boolean(),
            'tire_air_pressure' => $this->faker->boolean(),
            'shock_Struts' => $this->faker->boolean(),
            'ball_joints_and_bushings' => $this->faker->boolean(),

            'description_of_service' => $this->faker->optional()->sentence(),
            'is_outside_service_required' => $this->faker->boolean(),
            'outside_service_required' => $this->faker->word(),
            'outside_service_po' => strtoupper($this->faker->bothify('PO-#####')),
            'maintenance_technician' => $this->faker->name(),
        ];
    }
}
