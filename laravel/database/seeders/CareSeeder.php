<?php

namespace Database\Seeders;

use App\Models\Care;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use Illuminate\Database\Seeder;
use RuntimeException;

class CareSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = Schedule::with([
            'assignments' => fn ($q) => $q->where('role', 'caregiver')
        ])->get();

        if ($schedules->isEmpty()) {
            throw new RuntimeException('No schedules found');
        }

        foreach ($schedules as $schedule) {
            foreach ($schedule->assignments as $assignment) {

                // Patients in the caregiver’s care group
                $patients = Patient::where('care_group', $assignment->care_group)->get();

                foreach ($patients as $patient) {

                    // Prevent duplicate daily care records
                    $exists = Care::where('patient_id', $patient->patient_id)
                        ->where('care_date', $schedule->schedule_date)
                        ->exists();

                    if ($exists) {
                        continue;
                    }

                    $meds = match ($assignment->shift) {
                        'morn'  => ['med_morn' => true],
                        'noon'  => ['med_noon' => true],
                        'eve'   => ['med_eve' => true],
                        'night' => ['med_night' => true],
                    };

                    Care::factory()->create(array_merge([
                        'patient_id' => $patient->patient_id,
                        'emp_id'     => $assignment->emp_id,
                        'care_date'  => $schedule->schedule_date,
                    ], $meds));
                }
            }
        }
    }
}
