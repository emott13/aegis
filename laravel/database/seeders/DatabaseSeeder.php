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
                ScheduleSeeder::class,
            ]
        );

        User                ::factory(count: 40)->create();

        Employee            ::factory(count: 15)->create();
        Patient             ::factory(count: 15)->create();

        EmergencyContact    ::factory(count: 20)->create();
        Care                ::factory(count: 20)->create();
        Appointment         ::factory(count: 20)->create();

        Schedule            ::factory(count: 10)->create();
        ScheduleAssignment  ::factory(count: 40)->create();
    }
}
