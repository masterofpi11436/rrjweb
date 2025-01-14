<?php

namespace Database\Seeders;

// Required Models
use App\Models\ICS\ICS;
use App\Models\VFM\VFM;
use App\Models\VFM\VFM30;
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
        $warehouseRoles = [
            ['name' => 'Warehouse Supervisor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Warehouse Technician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Property', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Requestor', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('warehouse_roles')->insertOrIgnore($warehouseRoles);

        // Retrieve the ID of the 'user' role
        $userRoleId = DB::table('warehouse_roles')->where('name', 'Requestor')->value('id');

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
                'policy' => false,
                'warehouse_role_id' => $userRoleId, // Default role
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
                'vfm_tech' => true,
                'ics' => false,
                'policy' => false,
                'warehouse_role_id' => $userRoleId, // Default role
                'created_at' => now(),
                'updated_at' => now(),
            ],            [
                'last_name' => 'Flexon',
                'first_name' => 'Tim',
                'email' => 'tflexon@rrjva.org',
                'password' => Hash::make('admin'),
                'admin' => false,
                'phone' => false,
                'vfm' => true,
                'vfm_tech' => true,
                'ics' => false,
                'policy' => false,
                'warehouse_role_id' => $userRoleId, // Default role
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
                'policy' => false,
                'warehouse_role_id' => $userRoleId, // Default role
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
            ['name' => 'Pending Supervisor Approval'],
            ['name' => 'Pending Warehouse Approval'],
            ['name' => 'Approved'],
            ['name' => 'Denied'],
        ]);

        // Populate random data for applications
        PhoneDirectory::factory()->count(250)->create();
        VFM::factory()->count(100)->create();
        VFM30::factory()->count(100)->create();
        ICS::factory()->count(100)->create();
    }
}
