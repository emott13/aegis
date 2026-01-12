<?php

namespace Database\Seeders;

use App\Models\EmergencyContact;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmergencyContactSeeder extends Seeder
{
    public function run(): void
    {
        Patient::all()->each(callback: function (Patient $patient): void {
            EmergencyContact::factory()->count(rand(min: 1, max: 2))->create([
                'patient_id' => $patient->patient_id,
            ]);
        });
    }
}

