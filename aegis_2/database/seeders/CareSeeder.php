<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientIds = DB::table('patients')->pluck('patient_id');
        $caregiverIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->join('employees', 'users.user_id', 'employees.user_id')
            ->where('access_roles.role_name', 'caregiver')
            ->pluck('emp_id');
        
        $min = min(count($patientIds), count($caregiverIds));
        for ($i = 0; $i < $min; $i++)
        {
            DB::table('cares')->insert([
                'med_morn' => fake()->optional(.7)->boolean(),
                'med_noon' => fake()->optional(.7)->boolean(),
                'med_night' => fake()->optional(.7)->boolean(),
                'breakfast' => fake()->optional(.7)->boolean(),
                'lunch' => fake()->optional(.7)->boolean(),
                'dinner' => fake()->optional(.7)->boolean(),

                'care_date' => fake()->date(),
                'patient_id' => $patientIds[$i],
                'emp_id' => $caregiverIds[$i],
            ]);
        }
        
    }
}
