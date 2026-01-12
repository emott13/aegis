<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use RuntimeException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleAssignmentSeeder extends Seeder
{
    private const CARE_GROUPS = ['red', 'blue', 'green', 'yellow'];
    private const SHIFTS = ['morn', 'noon', 'eve', 'night'];

    public function run(): void
    {
        $employees = Employee::with('user.role')
            ->get()
            ->keyBy('emp_id');
        $schedules = Schedule::pluck(column: 'schedule_id');

        if (empty($employees) || $schedules->isEmpty()) {
            throw new RuntimeException('Missing employees or schedules');
        }

        foreach ($schedules as $scheduleId) {
            $availableEmployees = $employees->keys()->shuffle();

            foreach (self::SHIFTS as $shift) {      // Ensure unique employee per shift
                if ($availableEmployees->isEmpty()) {                   
                    break;                                              // Break if no more available employees
                }

                $empId = $availableEmployees->pop();                    // Assign and remove employee from available list
                $employee = $employees[$empId];
                $role = $employee->user->role->role_name;


                $data = [
                    'schedule_id' => $scheduleId,
                    'emp_id' => $empId,
                    'shift' => $shift,
                ];


                if ($role === 'caregiver') {
                    static $usedGroups = [];
                    $usedGroups[$scheduleId][$shift] ??= [];

                    $availableGroups = array_diff(
                        self::CARE_GROUPS,
                        $usedGroups[$scheduleId][$shift]
                    );

                    if (empty($availableGroups)) {
                        continue;
                    }

                    $group = collect($availableGroups)->random();
                    $usedGroups[$scheduleId][$shift][] = $group;

                    $data['care_group'] = $group;
                }

                if (in_array($role, ['doctor', 'supervisor', 'caregiver'])) {
                    ScheduleAssignment::factory()->create($data);
                }
            }
        }
    }
}