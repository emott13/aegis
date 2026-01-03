<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccessRoleFactory extends Factory
{
    public function definition(): array
    {
        static $roles = [
            ['admin']       ,
            ['supervisor']  ,
            ['doctor']      ,
            ['caregiver']   ,
            ['patient']     ,
            ['family']      ,
        ];

        $role = $roles[array_rand(array: $roles)]  ;   //  randomly select a role

        return [
            'role_name' => $role[0],
        ];
    }
}

?>