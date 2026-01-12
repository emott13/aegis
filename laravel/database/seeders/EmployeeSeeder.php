<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        User::whereHas(relation: 'role', callback: function ($q): void {
            $q->whereIn('role_name', ['admin', 'doctor', 'caregiver', 'supervisor',]);
        })->each(callback: function ($user): void {
            Employee::factory()->create(attributes: [
                'user_id' => $user->user_id,
            ]);
        });
    }
}
