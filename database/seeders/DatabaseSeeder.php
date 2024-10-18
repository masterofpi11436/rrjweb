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
        // Populate random data for applications
        PhoneDirectory::factory()->count(25)->create();
        InmateTablet::factory()->count(50)->create();
    }
}
