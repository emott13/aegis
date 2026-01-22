<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use RuntimeException;

class ScheduleAssignmentSeeder extends Seeder
{
    private const CARE_GROUPS = ['yellow', 'red', 'blue', 'green'];

    private const SHIFTS = [
        'morn' => ['doctor' => 1, 'supervisor' => 1, 'caregiver' => 4],
        'noon' => ['doctor' => 1, 'supervisor' => 1, 'caregiver' => 4],
        'eve'  => ['doctor' => 1, 'supervisor' => 1, 'caregiver' => 4],
        'night'=> ['doctor' => 0, 'supervisor' => 1, 'caregiver' => 4],
    ];

    public function run(): void
    {
        $employees = Employee::with('user.role')->get();

        $byRole = [
            'doctor'     => $employees->where('user.role.role_name', 'doctor')->values(),
            'supervisor' => $employees->where('user.role.role_name', 'supervisor')->values(),
            'caregiver'  => $employees->where('user.role.role_name', 'caregiver')->values(),
        ];

        foreach ($byRole as $role => $list) {
            if ($list->isEmpty()) {
                throw new RuntimeException("No employees found for role: {$role}");
            }
        }

        $start = Carbon::today();
        $end   = Carbon::today()->addDays(30);

        for ($date = $start; $date->lte($end); $date->addDay()) {

            $schedule = Schedule::firstOrCreate([
                'schedule_date' => $date->toDateString(),
            ]);

            // Reset pools DAILY (no reuse across shifts)
            $doctorPool     = $byRole['doctor']->shuffle()->values();
            $supervisorPool = $byRole['supervisor']->shuffle()->values();
            $caregiverPool  = $byRole['caregiver']->shuffle()->values();

            foreach (self::SHIFTS as $shift => $needs) {

                /** -------- Doctors -------- */
                for ($i = 0; $i < $needs['doctor']; $i++) {
                    $this->createAssignment(
                        $schedule->schedule_id,
                        $doctorPool->shift()->emp_id,
                        'doctor',
                        $shift,
                        null
                    );
                }

                /** ------ Supervisors ------ */
                for ($i = 0; $i < $needs['supervisor']; $i++) {
                    $this->createAssignment(
                        $schedule->schedule_id,
                        $supervisorPool->shift()->emp_id,
                        'supervisor',
                        $shift,
                        null
                    );
                }

                /** ------ Caregivers ------- */
                if ($needs['caregiver'] > 0) {
                    foreach (self::CARE_GROUPS as $group) {
                        $this->createAssignment(
                            $schedule->schedule_id,
                            $caregiverPool->shift()->emp_id,
                            'caregiver',
                            $shift,
                            $group
                        );
                    }
                }
            }
        }
    }

    private function createAssignment(
        int $scheduleId,
        int $empId,
        string $role,
        string $shift,
        ?string $careGroup
    ): void {
        ScheduleAssignment::factory()->create([
            'schedule_id' => $scheduleId,
            'emp_id'      => $empId,
            'role'        => $role,
            'shift'       => $shift,
            'care_group'  => $careGroup, // NULL for non-caregivers
        ]);
    }
}
