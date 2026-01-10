<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AccessRole;

class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB  ::  table   (table: 'access_roles')    ->  insert  (values: [  //  role_id AI at 1000
            ['role_name' => 'admin']        ,               //  can:
            ['role_name' => 'supervisor']   ,               //  can:
            ['role_name' => 'doctor']       ,               //  can:
            ['role_name' => 'caregiver']    ,               //  can:
            ['role_name' => 'patient']      ,               //  can:
            ['role_name' => 'family']       ,               //  can:
        ]);
    }
}