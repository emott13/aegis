<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AccessRole;


class AccessRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'admin',
            'supervisor',
            'doctor',
            'caregiver',
            'patient',
            'family',
        ];

        foreach ($roles as $role) {
            AccessRole::firstOrCreate(
                attributes: [
                    'role_name' => $role
                ]
            );
        }
    }
}