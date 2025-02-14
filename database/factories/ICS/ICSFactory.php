<?php

namespace Database\Factories\ICS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ICSFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inmate_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'date_found' => $this->faker->date,
            'charged_101' => $this->faker->boolean,
            'filed_with_inmate_accounts' => $this->faker->boolean,
            'charged_by_inmate_accounts' => $this->faker->boolean,
            'payment_status' => $this->faker->boolean,
            'notes' => $this->faker->text(200),
        ];
    }
}
