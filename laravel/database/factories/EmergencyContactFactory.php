<?php

namespace Database\Factories;

use App\Models\EmergencyContact;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmergencyContactFactory extends Factory
{
    protected $model = EmergencyContact::class;

    public function definition(): array
    {
        return [
            'em_fname' => $this->faker->firstName(),
            'em_lname' => $this->faker->lastName(),
            'em_phone' => $this->faker->numerify(string: '##########'),
            'relation' => $this->faker->randomElement(array: ['Spouse','Parent','Sibling','Child','Friend','Other']),
            'patient_id' => Patient::inRandomOrder()->value('patient_id'),
        ];
    }
}
