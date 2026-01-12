<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'schedule_date' => now()->addDays(value: rand(min: 1, max: 30))->toDateString(),
            // 'created_by'    => User::get()->value(key: 'role_name')->where(value: 'admin')->random()->user_id,
        ];
    }
}
