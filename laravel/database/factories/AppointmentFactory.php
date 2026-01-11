<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'appt_date'     => now()->addDays(value: rand(min: 1, max: 30))->toDateString(),
            'appt_time'     => $this->faker->time(format: 'H:i'),
            'appt_comment'  => $this->faker->sentence(),
            'patient_id'    => Patient::inRandomOrder()->value('patient_id'),
            'doctor_id'     => Employee::inRandomOrder()->value('emp_id'),
        ];
    }
}
