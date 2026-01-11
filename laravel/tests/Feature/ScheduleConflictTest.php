<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;

class ScheduleConflictTest extends TestCase
{
    use RefreshDatabase;

    protected function runTest(): mixed
    {
        return parent::runTest();
    }

    // test
    public function seeded_schedules_have_no_employee_conflicts(): void                                     // Test to ensure no employee is scheduled more than once per day
    {
        $this->seed();                                                                                      // runs DatabaseSeeder

        $conflicts = ScheduleAssignment::query()
            ->join('schedules', 'schedule_assignments.schedule_id', '=', 'schedules.schedule_id')
            ->selectRaw('schedules.schedule_date, schedule_assignments.emp_id, COUNT(*) as total')
            ->groupBy('schedules.schedule_date', 'schedule_assignments.emp_id')
            ->having('total', '>', 1)
            ->get();

        $this->assertCount(
            0,
            $conflicts,
            'Found employees scheduled more than once per day'
        );
    }

    //test
    public function database_prevents_duplicate_employee_assignments(): void                      // Test to ensure database constraint prevents duplicate employee assignments on the same day
    {
        $this->seed();

        $assignment = ScheduleAssignment::first();

        $this->expectException(\Illuminate\Database\QueryException::class);

        ScheduleAssignment::create([
            'schedule_id' => $assignment->schedule_id,
            'emp_id' => $assignment->emp_id, // same employee
            'shift' => 'evening',
            'role' => 'doctor',
        ]);
    }

    // test
    public function api_prevents_employee_being_scheduled_twice()
    {
        $this->seed();

        $assignment = ScheduleAssignment::first();

        $response = $this->postJson("/api/schedules/{$assignment->schedule_id}/assignments", [
            'emp_id' => $assignment->emp_id,
            'shift' => 'evening',
            'role' => 'doctor',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['emp_id']);
    }
}
