<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call(class: [
            AccessRoleSeeder    ::  class   ,   // seeds access roles
            UserSeeder          ::  class   ,   // seeds users
            PatientSeeder       ::  class   ,   // seeds patients
            EmployeeSeeder      ::  class   ,   // seeds employees
            AppointmentSeeder   ::  class   ,   // seeds appointments
            CareSeeder          ::  class   ,   // seeds care records
            ScheduleSeeder      ::  class   ,   // seeds schedules
        ]);
    }
}
