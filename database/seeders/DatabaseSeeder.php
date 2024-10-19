<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Login\Role;


use App\Models\Login\User;

// Required Models
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tablet\InmateTablet;
use Illuminate\Support\Facades\Hash;
use App\Models\Directory\PhoneDirectory;

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
                'remember_token' => Str::random(10),
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
                'remember_token' => Str::random(10),
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
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(25)->create();
        InmateTablet::factory()->count(50)->create();
    }
}
