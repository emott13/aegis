<?php

namespace Database\Factories;

use App\Models\ScheduleAssignment;
use App\Models\Schedule;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleAssignmentFactory extends Factory
{
    protected $model = ScheduleAssignment::class;

    public function definition(): array
    {
        return [
            // 'shift'         => $this->faker->randomElement(array: ['morn','noon','eve','night']),
            // 'role'          => $this->faker->randomElement(array: ['doctor','supervisor','caregiver']),
            // 'care_group'    => $this->faker->randomElement(array: ['red','blue','green','yellow']),
            // 'schedule_id'   => Schedule::inRandomOrder()->value('schedule_id'),
            // 'emp_id'        => Employee::inRandomOrder()->value('emp_id'),

            
            'shift'         => $this->faker->randomElement(array: ['morn','noon','eve','night']),
            'role'          => $this->faker->randomElement(array: ['doctor','supervisor','caregiver']),
            
        ];
    }
}
