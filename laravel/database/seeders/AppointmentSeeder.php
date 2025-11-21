<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientIds = DB::table('patients')->pluck('patient_id');
        $doctorIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->join('employees', 'users.user_id', 'employees.user_id')
            ->where('access_roles.role_name', 'doctor')
            ->pluck('emp_id');
        
        $min = min(count($patientIds), count($doctorIds));
        for ($i = 0; $i < $min; $i++)
        {
            DB::table('appointments')->insert([
                'appt_date' => fake()->date(),
                'patient_id' => $patientIds[$i],
                'doctor_id' => $doctorIds[$i],
                'doc_comment' => fake()->text(),
            ]);
        }
    }
}
