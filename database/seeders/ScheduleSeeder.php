<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->join('employees', 'users.user_id', 'employees.user_id')
            ->where('access_roles.role_name', 'doctor')
            ->pluck('emp_id');
        $supervisorIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->join('employees', 'users.user_id', 'employees.user_id')
            ->where('access_roles.role_name', 'doctor')
            ->pluck('emp_id');
        $caregiverIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->join('employees', 'users.user_id', 'employees.user_id')
            ->where('access_roles.role_name', 'caregiver')
            ->pluck('emp_id');
        
        $n = count($doctorIds)*5;
        for ($i = 0; $i < $n; $i++)
        {
            DB::table('schedules')->insert([
                'schedule_date' => fake()->date(),
                'made_by' => fake()->randomElement($doctorIds),
                'doctor_id' => fake()->randomElement($doctorIds),
                'supervisor_id' => fake()->randomElement($supervisorIds),
                'care_red' => fake()->randomElement($caregiverIds),
                'care_blue' => fake()->randomElement($caregiverIds),
                'care_green' => fake()->randomElement($caregiverIds),
                'care_yellow' => fake()->randomElement($caregiverIds),
            ]);
        }

    }
}
