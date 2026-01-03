<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\AccessRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'fname'             =>  $this   ->  faker ->    boolean     (chanceOfGettingTrue: 50)    ?   $this   ->  faker   ->  firstNameFemale ()  :   $this   ->  faker           ->  firstNameMale   () ,                     
            'lname'             =>  $this   ->  faker ->    lastName    ()                                                                                                                                  ,
            'dob'               =>  $this   ->  faker ->    date        (format: 'Y-m-d', max: '-21 years')                                                                                                 ,
            'email'             =>  $this   ->  faker ->    unique      ()                               ->  match   ('/^[a-zA-Z0-9._%+-]+@aegishealth.com$/')   ->  safeEmail                            (),
            'approved'          =>  $this   ->  faker ->    boolean     (chanceOfGettingTrue: 80)                                                                                                           ,
            'phone'             =>  $this   ->  faker ->    phoneNumber ()                                          ,                                                                                                                                                
            'email_verified_at' =>                              now             (),
            'password'          =>              Hash        ::  make            (value: 'password')                 ,   //  simple default,
            'remember_token'    =>              Str         ::  random          (length: 10)                        ,
            'role_id'           =>              AccessRole  ::  inRandomOrder   ()  ->  value   ('role_id')             // assign random role
        ];
    }

    public function admin(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'admin')->value(column: 'role_id')
        ]);
    }

    public function supervisor(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'supervisor')->value(column: 'role_id')
        ]);
    }

    public function doctor(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'doctor')->value(column: 'role_id')
        ]);
    }

    public function caregiver(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'caregiver')->value(column: 'role_id')
        ]);
    }

    public function patient(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'patient')->value(column: 'role_id')
        ]);
    }

    public function family(): UserFactory
    {
        return $this->state(state: fn (): array => [
            'role_id' => AccessRole::where(column: 'role_name', operator: 'family')->value(column: 'role_id')
        ]);
    }

}