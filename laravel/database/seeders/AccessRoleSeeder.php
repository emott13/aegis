<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB  ::  table   ('access_roles')    ->  insert  ([  //  role_id AI at 1000
            ['role_name' => 'admin']        ,               //  can:
            ['role_name' => 'supervisor']   ,               //  can:
            ['role_name' => 'doctor']       ,               //  can:
            ['role_name' => 'caregiver']    ,               //  can:
            ['role_name' => 'patient']      ,               //  can:
            ['role_name' => 'family']       ,               //  can:
        ]);
    }
}