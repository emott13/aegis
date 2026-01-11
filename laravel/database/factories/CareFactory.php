<?php

namespace Database\Factories;

use App\Models\Care;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class CareFactory extends Factory
{
    protected $model = Care::class;

    public function definition(): array
    {
        return [
            'care_date' => now()->toDateString(),

            'med_morn'  => $this->faker->boolean(chanceOfGettingTrue: 80),
            'med_noon'  => $this->faker->boolean(chanceOfGettingTrue: 80),
            'med_even'  => $this->faker->boolean(chanceOfGettingTrue: 80),
            'med_night' => $this->faker->boolean(chanceOfGettingTrue: 80),

            'breakfast' => $this->faker->boolean(chanceOfGettingTrue: 90),
            'lunch'     => $this->faker->boolean(chanceOfGettingTrue: 50),
            'dinner'    => $this->faker->boolean(chanceOfGettingTrue: 75),

            'patient_id'    => Patient::inRandomOrder()->value('patient_id'),
            'emp_id'        => Employee::inRandomOrder()->value('emp_id'),
        ];
    }
}
