<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

// use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    public function definition(): array
    {
        return [
            'hire_date' =>  $this   ->  faker   ->  date            (format: 'Y-m-d', max: '-2')   ,                          
            'salary'    =>  $this   ->  faker   ->  numberBetween   (int1: 60000, int2: 170000)     ,
            'user_id'   =>  User::query()->inRandomOrder()->value(column: 'user_id')                 ,   //  filled in by UserFactory
        ];
    }

    // relationships
    // public function doctor(): static
    // {
    //     return $this->state(state: fn(): array => [
    //         'role_id' => AccessRole::where(column: 'role_name', operator: 'doctor')->value(column: 'role_id'),
    //     ]);
    // }

    // public function caregiver(): static
    // {
    //     return $this->state(state: fn(): array => [
    //         'role_id' => AccessRole::where(column: 'role_name', operator: 'caregiver')->value(column: 'role_id'),
    //     ]);
    // }

    // public function supervisor(): static
    // {
    //     return $this->state(state: fn(): array => [
    //         'role_id' => AccessRole::where(column: 'role_name', operator: 'supervisor')->value(column: 'role_id'),
    //     ]);
    // }
}