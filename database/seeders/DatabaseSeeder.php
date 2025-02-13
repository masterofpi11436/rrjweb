<?php

namespace Database\Seeders;

// Required Models
use App\Models\ICS\ICS;
use App\Models\VFM\VFM;
use App\Models\VFM30\VFM30;
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
                'last_name' => 'Tuggle',
                'first_name' => 'Mark',
                'email' => 'tugglem@rrjva.org',
                'password' => Hash::make('asd'),
                'admin' => true,
                'phone' => false,
                'vfm' => false,
                'vfm30' => false,
                'vfm_tech' => false,
                'ics' => false,
                'policy' => false,
                'warehouse_role' => 'Warehouse Supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Feury',
                'first_name' => 'Lonnie',
                'email' => 'feury.lonnie@rrjva.org',
                'password' => Hash::make('admin'),
                'admin' => false,
                'phone' => false,
                'vfm' => true,
                'vfm30' => true,
                'vfm_tech' => true,
                'ics' => false,
                'policy' => false,
                'warehouse_role' => 'Requestor',
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
                'vfm30' => true,
                'vfm_tech' => true,
                'ics' => false,
                'policy' => false,
                'warehouse_role' => 'Requestor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => 'Watson',
                'first_name' => 'Charles',
                'email' => 'watson.charles@rrjva.org',
                'password' => Hash::make('admin'),
                'admin' => false,
                'phone' => false,
                'vfm' => false,
                'vfm30' => false,
                'vfm_tech' => false,
                'ics' => false,
                'policy' => false,
                'warehouse_role' => 'Warehouse Supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('sections')->insert([
            ['section' => 'Administration'],
            ['section' => 'Booking'],
            ['section' => 'C&T'],
            ['section' => 'Captains Hall'],
            ['section' => 'Classification'],
            ['section' => 'Compliance'],
            ['section' => 'Housekeeping'],
            ['section' => 'HUM'],
            ['section' => 'Housing Unit 1'],
            ['section' => 'Housing Unit 2'],
            ['section' => 'Housing Unit 3'],
            ['section' => 'Housing Unit 4'],
            ['section' => 'Housing Unit 5'],
            ['section' => 'Housing Unit 6'],
            ['section' => 'Maintenance'],
            ['section' => 'Medical Housing'],
            ['section' => 'Movement'],
            ['section' => 'OPR'],
            ['section' => 'Programs'],
            ['section' => 'Property'],
            ['section' => 'Records'],
            ['section' => 'SEC'],
            ['section' => 'SHU-A'],
            ['section' => 'SHU-B'],
            ['section' => 'Warehouse'],
        ]);

        DB::table('categories')->insert([
            ['category' => 'Housekeeping Supplies'],
            ['category' => 'Office Supplies'],
            ['category' => 'Printer Ink'],
            ['category' => 'Personal Care'],
            ['category' => 'Property'],
            ['category' => '1 for 1 Exchange'],
        ]);

        DB::table('statuses')->insert([
            ['status' => 'Pending Supervisor Approval'],
            ['status' => 'Pending Warehouse Approval'],
            ['status' => 'Approved'],
            ['status' => 'Denied'],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(250)->create();
        VFM::factory()->count(100)->create();
        VFM30::factory()->count(100)->create();
        ICS::factory()->count(100)->create();
    }
}
