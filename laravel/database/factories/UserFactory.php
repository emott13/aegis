<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    // variables
    protected static ?string $password;                             // current factory password

    // methods
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'dob' => fake()->date(),
            'phone' => fake()->numerify('##########'),
            'approved' => fake()->boolean(),
            'role_id' => fake()->numberBetween(1, 6),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($user) {

            $role = $user->role->role_name;                                         // retreive user role

            if (in_array($role, ['supervisor', 'doctor', 'caregiver'])) {           // if employee type
                if ($user->dob <= now()->subYears(rand(18, 64))) {                      // set age between 18-64
                    \App\Models\Employee::factory()->create([
                        'user_id' => $user->user_id,
                    ]);
                }
            }

            if ($role === 'patient') {                                              // if patient type
                \App\Models\Patient::factory()->create([                            
                    'user_id' => $user->user_id,
                ]);
            }

        });
    }
}

?>