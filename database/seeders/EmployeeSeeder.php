<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->whereNotIn('access_roles.role_name', ['patient', 'family'])
            ->pluck('user_id');
        
        foreach ($userIds as $userId)
        {
            DB::table('employees')->insert([
                'hire_date' => fake()->date(),
                'salary' => fake()->randomNumber(),
                'user_id' => $userId,
            ]);
        }
    }
}
