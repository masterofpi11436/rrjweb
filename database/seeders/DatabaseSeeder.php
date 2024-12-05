<?php

namespace Database\Seeders;

// Required Models
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tablet\InmateTablet;
use Illuminate\Support\Facades\Hash;
use App\Models\Directory\PhoneDirectory;
use App\Models\OPR\OPRList;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'last_name' => 'Tuggle',
                'first_name' => 'Mark',
                'email' => 'masterofpi11436@gmail.com',
                'password' => Hash::make('asd'),
                'admin' => true,
                'phone' => false,
                'tablet' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Smith',
                'first_name' => 'Jane',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('asd'),
                'admin' => false,
                'phone' => true,
                'tablet' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Brown',
                'first_name' => 'Alice',
                'email' => 'alice.brown@example.com',
                'password' => Hash::make('asd'),
                'admin' => false,
                'phone' => false,
                'tablet' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Tuggle',
                'first_name' => 'Mark',
                'email' => 'tugglem@rrjva.org',
                'password' => Hash::make('asd'),
                'admin' => true,
                'phone' => false,
                'tablet' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(250)->create();
        InmateTablet::factory()->count(50)->create();
        OPRList::factory()->count(50)->create();
    }
}
