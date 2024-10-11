<?php

namespace Database\Factories\Login;

use App\Models\Login\Role;
use App\Models\Login\User;
use App\Models\Login\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserApplicationRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // Reference a user
            'application_id' => Application::factory(),  // Reference an application
            'role_id' => Role::factory(),  // Reference a role
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
