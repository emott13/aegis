<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccessRole;

class AccessRoleFactory extends Factory
{
    protected $model = AccessRole::class;

    public function definition(): array
    {
        return [
            // Default fallback (not used for system roles)
            'role_name' => $this->faker->unique()->word(),
        ];
    }

    /**
     * System role states
     */
    public function admin(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'admin']);
    }

    public function supervisor(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'supervisor']);
    }

    public function doctor(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'doctor']);
    }

    public function caregiver(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'caregiver']);
    }

    public function patient(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'patient']);
    }

    public function family(): static
    {
        return $this->state(state: fn (): array => ['role_name' => 'family']);
    }
}
