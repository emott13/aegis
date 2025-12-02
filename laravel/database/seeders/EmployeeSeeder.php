<?php
// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\User;
// use App\Models\Employee;
// use Carbon\Carbon;

// class EmployeeSeeder extends Seeder
// {
//     public function run(): void
//     {
//         // Get all users that should become employees
//         $eligibleUsers = User::query()
//             ->whereHas('AccessRole', function ($q) {
//                 $q->whereNotIn('role_name', ['patient', 'family']);
//             })
//             ->where('dob', '<=', Carbon::now()->subYears(18))
//             ->doesntHave('employee') // user is not already an employee
//             ->get();

//         // Create employees for each eligible user
//         foreach ($eligibleUsers as $user) {
//             Employee::factory()->create([
//                 'user_id' => $user->user_id,
//             ]);
//         }
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Get users eligible to become employees
        $users = User::query()
            ->whereHas('AccessRole', function ($q) {
                $q->whereNotIn('role_name', ['patient', 'family']);
            })
            ->where('dob', '<=', now()->subYears(18))
            ->doesntHave('employee')
            ->get();

        foreach ($users as $user) {
            // Create employee using factory binding
            $user->employee()->create(
                \App\Models\Employee::factory()->make()->toArray()
            );
        }
    }
}
