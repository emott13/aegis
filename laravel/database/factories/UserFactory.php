<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;


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
            'role_id' => rand(2, 6),
            'approved' => fake()->boolean(),
        ];
    }
    
    public function employee(): Factory
    {
        return $this->afterCreating(function ($user) {
            // Age restriction: only users >= 18 can become employees
            if ($user->dob <= now()->subYears(18)) {
                \App\Models\Employee::factory()->create([
                    'user_id' => $user->user_id,
                ]);
            }
        });
    }


}