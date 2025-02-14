<?php

namespace Database\Factories\VFM;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VFMFactory extends Factory
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
            'air_filter' => $this->faker->boolean(),
            'antifreeze' => $this->faker->boolean(),
            'battery' => $this->faker->boolean(),
            'battery_booster' => $this->faker->boolean(),
            'belts' => $this->faker->boolean(),
            'brake_fluid' => $this->faker->boolean(),
            'brakes_front' => $this->faker->boolean(),
            'brakes_rear' => $this->faker->boolean(),
            'detention_equipment' => $this->faker->boolean(),
            'diagnostic_scan' => $this->faker->boolean(),
            'engine_oil' => $this->faker->boolean(),
            'exhaust' => $this->faker->boolean(),
            'hoses' => $this->faker->boolean(),
            'lights' => $this->faker->boolean(),
            'mirrors' => $this->faker->boolean(),
            'power_steering_fluid' => $this->faker->boolean(),
            'safety_restraints' => $this->faker->boolean(),
            'shocks_struts' => $this->faker->boolean(),
            'tires' => $this->faker->boolean(),
            'transmission_fluid' => $this->faker->boolean(),
            'vehicle_jump_starter' => $this->faker->boolean(),
            'washer_fluid' => $this->faker->boolean(),
            'window_operation' => $this->faker->boolean(),
            'windshield' => $this->faker->boolean(),
            'wiper_blades' => $this->faker->boolean(),
            'fire_extinguisher' => $this->faker->boolean(),
            'description_of_service' => $this->faker->paragraph(5),
            'maintenance_technician' => $this->faker->name(),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),

        ];
    }
}
