<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['admin', 0],
            ['employee', 5],
            ['doctor', 2],
            ['supervisor', 1],
            ['caregiver', 4],
            ['patient', 10],
            ['family', 10],
        ];

        foreach ($roles as $role)
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
