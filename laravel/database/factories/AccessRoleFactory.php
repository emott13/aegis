<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccessRoleFactory extends Factory
{
    public function definition(): array
    {
        static $roles = [
            ['admin', 1],
            ['supervisor', 2],
            ['doctor', 3],
            ['caregiver', 4],
            ['patient', 5],
            ['family', 6],
        ];

        $role = $roles[array_rand($roles)];

        return [
            'role_name' => $role[0],
            'access_level' => $role[1]
        ];
    }
}

?>