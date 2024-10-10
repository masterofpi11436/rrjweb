<?php

namespace Database\Factories\Login;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Admin', 'Manager', 'Supervisor', 'Property', 'Regular User']),
            'description' => $this->faker->sentence,
        ];
    }
}
