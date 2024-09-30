<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Required Models
use App\Models\Directory\PhoneDirectory;

class InmateTabletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InmateTablet::factory()->count(25)->create();
    }
}
