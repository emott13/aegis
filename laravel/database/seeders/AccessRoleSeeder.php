<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRoleSeeder extends Seeder
{
    // [role, access_level]
    public $roles = [
        ['admin', 0],
        ['supervisor', 1],
        ['doctor', 2],
        ['caregiver', 4],
        ['employee', 5],
        ['patient', 9],
        ['family', 10],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role)
        {
            DB::table('access_roles')->insert(
                [
                    'role_name' => $role[0],
                    'access_level' => $role[1],
                ]
            );
        }
    }
}
