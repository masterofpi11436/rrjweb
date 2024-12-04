<?php

namespace Database\Factories\OPR;

use Illuminate\Database\Eloquent\Factories\Factory;

// Required Models
use App\Models\Tablet\InmateTablet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OPRListFactory extends Factory
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
        ];
    }
}
