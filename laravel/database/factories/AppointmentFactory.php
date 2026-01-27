<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use Illuminate\Database\Eloquent\Factories\Factory;
use RuntimeException;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        // return [
        //     'appt_date'     => now()->addDays(value: rand(min: 1, max: 30))->toDateString(),
        //     'appt_time'     => $this->faker->time(format: 'H:i'),
        //     'doc_comment'  => $this->faker->sentence(),
        //     'patient_id'    => Patient::inRandomOrder()->value('patient_id'),
        //     'doctor_id'     => Employee::inRandomOrder()->value('emp_id'),
        // ];

        $schedule = Schedule::inRandomOrder()->first();

        if (!$schedule){
            throw new RuntimeException('No schedules');
        }

        //pick appt time
        // $time = $this->faker->randomElement([
        //     '06:00', '07:00', '08:00', '09:00', '10:00', '11:00',  // morn
        //     '12:30', '13:30', '14:30', '15:30', '16:30', '17:30',  // noon
        //     '18:30', '19:30', '20:30', '21:30'  // eve
        // ]);
        // var_dump($time);
        // //convert time to shift
        // $shift = $this -> timeToShift(($time));

        // find doc for shift and date
        $doctorAssignment = ScheduleAssignment::where('schedule_id', $schedule->schedule_id)
            // ->where('shift', $shift)
            ->where('role', 'doctor')
            ->first();

        if (!$doctorAssignment) {
            throw new RuntimeException("No doctor scheduled for {$schedule->schedule_date} {$shift}");
        }


        return [
            'appt_date'    => $schedule->schedule_date,
            // 'appt_time'    => $time,
            'appt_comment' => $this->faker->sentence(),

            'patient_id'   => Patient::inRandomOrder()->value('patient_id'),
            'doctor_id'    => $doctorAssignment->emp_id,
        ];
    }

    // private function timeToShift(string $time): string
    // {
    //     if ($time >= '06:00' && $time < '12:00') return 'morn';
    //     elseif ($time >= '12:00' && $time < '18:00') return 'noon';
    //     elseif ($time >= '18:00' && $time < '23:59') return 'eve';
    //     else return 'night'; // giving error if night?
    // }

}
