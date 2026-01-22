<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use RuntimeException;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $allowedRoles = ['admin', 'supervisor'];

        $userIds = User::whereHas(relation: 'role', callback: function ($q) use ($allowedRoles): void {
            $q->whereIn('role_name', $allowedRoles);
        })->pluck(column: 'user_id');

        if ($userIds->isEmpty()) {
            throw new RuntimeException(message: 'No admin or supervisor users found');
        }

        Schedule::factory()
            ->create(attributes: [
                'created_by' => $userIds->random(),
            ]);
    }


}