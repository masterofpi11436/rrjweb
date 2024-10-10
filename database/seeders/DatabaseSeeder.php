<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Required Models
use App\Models\Login\User;
use App\Models\Login\Application;
use App\Models\Login\Role;
use App\Models\Login\Permission;
use App\Models\Directory\PhoneDirectory;
use App\Models\Tablet\InmateTablet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $applications = [
            ['name' => 'Phone', 'description' => 'Handles phone-related operations'],
            ['name' => 'Tablet', 'description' => 'Manages tablet assignments and usage'],
            ['name' => 'OPR', 'description' => 'Operational records management'],
            ['name' => 'Inmate Mail', 'description' => 'Handles inmate mail processing'],
            ['name' => 'Warehouse Store', 'description' => 'Manages warehouse and store requests'],
        ];

        // Insert applications into the database
        foreach ($applications as $app) {
            Application::create($app);
        }

        // 2. Manually create specific roles (unchanged from previous examples)
        $roles = [
            ['name' => 'Administrator', 'description' => 'Administrator for all applications and users'],
            ['name' => 'Manager', 'description' => 'Manages the application and its users'],
            ['name' => 'Supervisor', 'description' => 'Approves or disapproves '],
            ['name' => 'Property', 'description' => 'Manages property and assets'],
            ['name' => 'Regular User', 'description' => 'Regular user with limited access'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Mark',
            'last_name' => 'Tuggle',
            'email' => 'tugglem@rrjva.org',
            'password' => bcrypt('password'),
        ]);

        PhoneDirectory::factory()->count(25)->create();
        InmateTablet::factory()->count(50)->create();
    }
}
