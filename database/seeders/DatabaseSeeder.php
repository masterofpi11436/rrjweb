<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Login\Role;


use Illuminate\Database\Seeder;

// Required Models
use App\Models\Login\User;
use App\Models\Login\Application;
use App\Models\Login\UserApplicationRole;
use App\Models\Tablet\InmateTablet;
use App\Models\Directory\PhoneDirectory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating real user(s)
        $realUsers = [
            [
                'first_name' => 'Mark',
                'last_name' => 'Tuggle',
                'email' => 'masterofpi11436@gmail.com',
                'password' => bcrypt('asd')
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane.doe@example.com',
                'password' => bcrypt('asd'), // Jane's password
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@example.com',
                'password' => bcrypt('asd'), // Jane's password
            ],
            // Add more users here later
        ];

        // Create real users if they don't already exist
        foreach ($realUsers as $userData) {
            $existingUser = User::where('email', $userData['email'])->first();
            if (!$existingUser) {
                User::create($userData);
            }
        }

        // Create additional random users
        User::factory(10)->create();

        // Creating real applications
        $realApplications = [
            ['name' => 'Administration', 'description' => 'Manage all users and applications'],
            ['name' => 'Phone Directory', 'description' => 'Phone directory management application'],
            ['name' => 'Inmate Tablet', 'description' => 'Tablet management for inmates'],
        ];

        foreach ($realApplications as $applicationData) {
            Application::create($applicationData);
        }

        // Create additional random applications
        Application::factory(3)->create();

        // Creating real roles
        $realRoles = [
            ['name' => 'Admin', 'app_name' => 'Administration'],
            ['name' => 'Admin', 'app_name' => 'Phone Directory'],
            ['name' => 'Admin', 'app_name' => 'Inmate Tablet'],
        ];

        foreach ($realRoles as $roleData) {
            Role::create($roleData);
        }

        // Create additional random roles
        Role::factory(5)->create();

        // Get the users and roles for assignments
        $mark = User::where('email', 'masterofpi11436@gmail.com')->first();
        $jane = User::where('email', 'jane.doe@example.com')->first();
        $john = User::where('email', 'john.smith@example.com')->first();

        // Get the applications
        $phoneDirectoryApp = Application::where('name', 'Phone Directory')->first();
        $inmateTabletApp = Application::where('name', 'Inmate Tablet')->first();
        $adminApp = Application::where('name', 'Administration')->first();

        // Get the admin roles
        $adminRolePhoneDirectory = Role::where('name', 'Admin')->where('app_name', 'Phone Directory')->first();
        $adminRoleInmateTablet = Role::where('name', 'Admin')->where('app_name', 'Inmate Tablet')->first();
        $adminRoleAdministration = Role::where('name', 'Admin')->where('app_name', 'Administration')->first();

        // Assign Admin role to Mark for all applications
        UserApplicationRole::create([
            'user_id' => $mark->id,
            'application_id' => $phoneDirectoryApp->id,
            'role_id' => $adminRolePhoneDirectory->id,
        ]);

        UserApplicationRole::create([
            'user_id' => $mark->id,
            'application_id' => $inmateTabletApp->id,
            'role_id' => $adminRoleInmateTablet->id,
        ]);

        UserApplicationRole::create([
            'user_id' => $mark->id,
            'application_id' => $adminApp->id,
            'role_id' => $adminRoleAdministration->id,
        ]);

        // Assign Admin role to Jane for Phone Directory
        UserApplicationRole::create([
            'user_id' => $jane->id,
            'application_id' => $phoneDirectoryApp->id,
            'role_id' => $adminRolePhoneDirectory->id,
        ]);

        // Assign Admin role to John for Inmate Tablet
        UserApplicationRole::create([
            'user_id' => $john->id,
            'application_id' => $inmateTabletApp->id,
            'role_id' => $adminRoleInmateTablet->id,
        ]);

        // Create additional random user-application-role assignments
        UserApplicationRole::factory(20)->create();

        // Populate random data for applications
        PhoneDirectory::factory()->count(25)->create();
        InmateTablet::factory()->count(50)->create();
    }
}
