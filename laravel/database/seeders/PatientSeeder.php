<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', 'patient')
            ->pluck('user_id');

        foreach ($userIds as $userId)
        {
            DB::table('patients')->insert([
                'family_code' => Str::random(10),
                'em_fname' => fake()->firstName(),
                'em_lname' => fake()->lastName(),
                'em_phone' => fake()->numerify('##########'),
                'em_relation' => fake()->randomElement(['mother', 'father', 'sibling', 'brother', 'sister', 'spouse', 'cousin', 'aunt', 'uncle', 'grandmother', 'grandfather']),
                'admission_date' => fake()->date(),
                'care_group' => fake()->randomElement(['red', 'blue', 'green', 'yellow']),
                'med_morn' => fake()->randomElement(['', 'Zyrtec', 'Tylenol']),
                'med_noon' => fake()->randomElement(['', 'Zyrtec', 'Tylenol']),
                'med_night' => fake()->randomElement(['', 'Zyrtec', 'Tylenol']),
                'bill_amount' => fake()->randomNumber(),
                'user_id' => $userId,
            ]);
        }
    }
}
