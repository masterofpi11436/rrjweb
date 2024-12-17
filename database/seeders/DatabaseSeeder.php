<?php

namespace Database\Seeders;

// Required Models
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Directory\PhoneDirectory;
use App\Models\VFM\VFM;

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
                'vfm' => true,
                'vfm_tech' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Flexon',
                'first_name' => 'Tim',
                'email' => 'tflexon@rrjva.org',
                'password' => Hash::make('admin'),
                'admin' => false,
                'phone' => false,
                'vfm' => true,
                'vfm_tech' => true,
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
                'vfm' => false,
                'vfm_tech' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(250)->create();
        VFM::factory()->count(100)->create();
    }
}
