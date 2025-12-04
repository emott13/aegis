<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_id' => 1, 'role_name' => "admin", 'access_level' => 1],
            ['role_id' => 2, 'role_name' => "doctor", 'access_level' => 2],
            ['role_id' => 3, 'role_name' => "caregiver", 'access_level' => 3],
            ['role_id' => 4, 'role_name' => "supervisor", 'access_level' => 4],
            ['role_id' => 5, 'role_name' => "patient", 'access_level' => 5],
            ['role_id' => 6, 'role_name' => "family", 'access_level' => 6],
        ];

        DB::table('access_roles')->insert($roles);
        
    }
}
