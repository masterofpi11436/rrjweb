<?php

namespace Database\Factories\Directory;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Directory\PhoneDirectory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Directory\PhoneDirectory>
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
            'name' => $this->faker->name(),
            'title' => $this->faker->jobTitle(),
            'section' => $this->faker->word(), // Customize this for specific section names
            'extension' => $this->faker->numerify('####'),
        ];
    }
}
