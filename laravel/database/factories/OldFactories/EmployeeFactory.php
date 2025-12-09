<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hire_date' => $this->faker->date(),
            'salary'    => $this->faker->randomNumber(6, true),
            'user_id'   => User::factory(),  // default, will be overridden in seeder
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

