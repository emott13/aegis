<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;
// need to add unique constraint where employee in one section of schedule not present in other in same row
class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $minBirthdate = Carbon::now()->subYears(value: 18)->format(format: 'Y-m-d');

        $patientRoleId   =  AccessRole::where(column: 'role_name', operator: 'patient')->value(column: 'role_id');
        $familyRoleId    =  AccessRole::where(column: 'role_name', operator: 'family')->value(column: 'role_id');

        $eligibleUsers = User::where(column: 'dob', operator: '<=', value: $minBirthdate)
            ->whereNotIn('role_id', [$patientRoleId, $familyRoleId])
            ->whereDoesntHave('employee')  // not already an employee
            ->get();

        foreach ($eligibleUsers as $user) {
            Employee::create(attributes: [
                'user_id'   => $user->user_id,
                'hire_date' => now()->subDays(value: rand(min: 10, max: 365)),
                'salary'    => rand(min: 80000, max: 220000),
            ]);
        };
    }
}
