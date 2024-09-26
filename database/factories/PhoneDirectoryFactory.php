<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneDirectory>
 */
class PhoneDirectoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name, // Generates a random name
            'title' => $this->faker->jobTitle, // Generates a random job title
            'section' => $this->faker->randomElement(['HR', 'IT', 'Finance', 'Marketing', 'Sales']), // Random section from predefined list
            'extension' => $this->faker->numerify('####'), // Generates a random 4-digit extension
        ];
    }
}
