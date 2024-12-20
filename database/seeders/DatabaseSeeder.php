<?php

namespace Database\Seeders;

// Required Models
use App\Models\ICS\ICS;
use App\Models\VFM\VFM;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'last_name' => 'Scott',
                'first_name' => 'Heather',
                'email' => 'heather.scott@icsolutions.com',
                'password' => Hash::make('admin'),
                'admin' => false,
                'phone' => false,
                'vfm' => false,
                'vfm_tech' => false,
                'ics' => true,
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
                'ics' => false,
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
                'ics' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(250)->create();
        VFM::factory()->count(100)->create();
        ICS::factory()->count(100)->create();
    }
}
