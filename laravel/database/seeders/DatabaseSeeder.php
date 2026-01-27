<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\EmergencyContact;
use App\Models\Care;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this   ->  call (
            class: [
                AccessRoleSeeder::class,
                UserSeeder::class,
                EmployeeSeeder::class,
                PatientSeeder::class,
                EmergencyContactSeeder::class,
                ScheduleSeeder::class,
                ScheduleAssignmentSeeder::class,
                AppointmentSeeder::class,
                CareSeeder::class,
            ]
        );


        // Employee            ::factory(count: 30)->create();
        // Patient             ::factory(count: 30)->create();

        // EmergencyContact    ::factory(count: 20)->create();
        // Care                ::factory(count: 20)->create();
        // Appointment         ::factory(count: 20)->create();

        // $this   ->  call (
        //     class: [
        //         ScheduleSeeder::class,
        //     ]
        // );
        // Schedule            ::factory(count: 10)->create();
        // ScheduleAssignment  ::factory(count: 40)->create();
    }
}
