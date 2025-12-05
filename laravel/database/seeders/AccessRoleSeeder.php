<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_id' => 1, 'role_name' => "ADMIN", 'access_level' => 1],
            ['role_id' => 2, 'role_name' => "DOCTOR", 'access_level' => 2],
            ['role_id' => 3, 'role_name' => "CAREGIVER", 'access_level' => 3],
            ['role_id' => 4, 'role_name' => "SUPERVISOR", 'access_level' => 4],
            ['role_id' => 5, 'role_name' => "PATIENT", 'access_level' => 5],
            ['role_id' => 6, 'role_name' => "FAMILY", 'access_level' => 6],
        ];

        DB::table('access_roles')->insertOrIgnore($roles);
    }
}
