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
        $minBirthdate = Carbon::now()->subYears(18)->format('Y-m-d');

        $patientRoleId   =  AccessRole::where('role_name', 'patient')->value('role_id');
        $familyRoleId    =  AccessRole::where('role_name', 'family')->value('role_id');

        $eligibleUsers = User::where('dob', '<=', $minBirthdate)
            ->whereNotIn('role_id', [$patientRoleId, $familyRoleId])
            ->whereDoesntHave('employee')  // not already an employee
            ->get();

        foreach ($eligibleUsers as $user) {
            Employee::create([
                'user_id'   => $user->user_id,
                'hire_date' => now()->subDays(rand(10, 1000)),
                'salary'    => rand(80000, 220000),
            ]);
        }
    }
}
