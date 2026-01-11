<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'family_code' => strtoupper($this->faker->bothify('FAM###')),
            'care_group' => $this->faker->randomElement(['red','blue','green','yellow']),
            'admission_date' => $this->faker->date(),
            'bill_amount' => 0,
            'user_id' => User::factory(),
        ];
    }
}
