<?php

namespace Database\Seeders;

use App\Models\AccessRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = AccessRole::pluck(column: 'role_id', key: 'role_name');

        // Admins
        User::factory()->count(count: 2)->create(attributes: [
            'role_id' => $roles['admin'],
        ]);
        
        // Employees
        User::factory()->count(count: 4)->create(attributes: [
            'role_id' => $roles['doctor'],
        ]);

        User::factory()->count(count: 16)->create(attributes: [
            'role_id' => $roles['caregiver'],
        ]);

        User::factory()->count(count: 4)->create(attributes: [
            'role_id' => $roles['supervisor'],
        ]);

        // Patients
        User::factory()->count(count: 10)->create(attributes: [
            'role_id' => $roles['patient'],
        ]);

        // Family
        User::factory()->count(count: 10)->create(attributes: [
            'role_id' => $roles['family'],
        ]);
    }
}
