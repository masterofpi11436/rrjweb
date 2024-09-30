<?php

namespace Database\Factories\Tablet;

use Illuminate\Database\Eloquent\Factories\Factory;

// Required Models
use App\Models\Tablet\InmateTablet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InmateTabletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inmate_number' => $this->faker->numberBetween(10000, 99999),
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->lastName,
            'date_tablet_found' => $this->faker->optional()->date(),
            'is_101_incident_report_filed' => $this->faker->boolean,
            'is_filed_by_inmate_accounts' => $this->faker->boolean,
            'is_charged_by_inmate_accounts' => $this->faker->boolean,
            'is_payed' => $this->faker->boolean,
            'notes' => $this->faker->optional()->text,
        ];
    }
}
