<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use App\Models\Employee;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $dates = collect(value: range(start: 1, end: 10))
            ->map(callback: fn (int $i): string => Carbon::now()->addDays(value: $i)->toDateString());

        foreach ($dates as $date) {
            $schedule = Schedule::create(attributes: [
                'schedule_date' => $date,
                'created_by' => Employee::inRandomOrder()->value('emp_id'),
            ]);

            $this->assignEmployees(schedule: $schedule);
        }
    }

    protected function assignEmployees(Schedule $schedule): void
    {
        $usedEmployees = collect();

        $roles = [
            ['shift' => 'morn', 'role' => 'doctor', 'count' => 1],
            ['shift' => 'morn', 'role' => 'supervisor', 'count' => 1],
            ['shift' => 'morn', 'role' => 'caregiver', 'count' => 4],
            ['shift' => 'noon', 'role' => 'doctor', 'count' => 1],
            ['shift' => 'noon', 'role' => 'supervisor', 'count' => 1],
            ['shift' => 'noon', 'role' => 'caregiver', 'count' => 4],
            ['shift' => 'eve', 'role' => 'doctor', 'count' => 1],
            ['shift' => 'eve', 'role' => 'supervisor', 'count' => 1],
            ['shift' => 'eve', 'role' => 'caregiver', 'count' => 4],
            ['shift' => 'night', 'role' => 'doctor', 'count' => 1],
            ['shift' => 'night', 'role' => 'supervisor', 'count' => 1],
            ['shift' => 'night', 'role' => 'caregiver', 'count' => 4],
        ];

        foreach ($roles as $slot) {
            for ($i = 0; $i < $slot['count']; $i++) {
                $employee = Employee::whereNotIn('emp_id', $usedEmployees)
                    ->inRandomOrder()
                    ->first();

                if (!$employee) {
                    return; // no more employees available
                }

                ScheduleAssignment::create([
                    'schedule_id' => $schedule->schedule_id,
                    'emp_id' => $employee->emp_id,
                    'shift' => $slot['shift'],
                    'role' => $slot['role'],
                ]);

                $usedEmployees->push(values: $employee->emp_id);
            }
        }
    }
}
