<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Required Models
use App\Models\Directory\PhoneDirectory;
use App\Models\Tablet\InmateTablet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        PhoneDirectory::factory()->count(25)->create();
        InmateTablet::factory()->count(50)->create();
    }
}
