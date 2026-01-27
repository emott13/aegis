<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        Appointment::factory()
            ->count(20)
            ->create();
        // $doctors = Employee::whereHas(relation: 'user.role', callback: function ($query): void {
        //     $query->where('role_name', 'doctor');
        // })->pluck(column: 'emp_id');

        // $patients = Patient::pluck(column: 'patient_id');

        // if ($doctors->isEmpty() || $patients->isEmpty()) {
        //     return;
        // }

        // foreach ($patients as $patientId) {
        //     Appointment::factory()->create(attributes: [
        //         'patient_id' => $patientId,
        //         'doctor_id' => $doctors->random(),
        //     ]);
        // }
    }
}
