<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create X fake users
        User::factory(200)->create();

        // DB::table('users')->insert([
        //     'fname' => Str::random(10),
        //     'lname' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        //     'dob' => Date::make('9050-01-01'),
        //     'phone' => '1231231234'
        // ]);
    }
}
