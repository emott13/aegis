<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        User::whereHas(relation: 'role', callback: fn ($q): mixed =>
            $q->where('role_name', 'patient')
        )->each(callback: function ($user): void {
            Patient::factory()->create(attributes: [
                'user_id' => $user->user_id,
            ]);
        });
    }
}

