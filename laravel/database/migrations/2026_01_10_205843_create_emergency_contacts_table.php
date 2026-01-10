<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                          // run the migrations
    {
        Schema::create(table: 'emergency_contacts', callback: function (Blueprint $table): void 
        {
            $table  ->  id              (column: 'em_id');
            $table  ->  string          (column: 'em_fname');
            $table  ->  string          (column: 'em_lname');
            $table  ->  string          (column: 'em_phone', length: 15);               // COLUMN phone num 15->(eg. +1-111-111-1111)
            $table  ->  string          (column: 'relation');

            $table  ->  foreignId       (column: 'patient_id')                          // FKID
                    ->  constrained     (table: 'patients', column: 'patient_id')       // CONSTRAINED
                    ->  onDelete        (action: 'cascade');                            // DELETES related parent--child records

            $table  ->  rememberToken   ();
            $table  ->  timestamps      ();
        });
    }

    public function down(): void                                                        // reverse the migrations
    {
        Schema::dropIfExists(table: 'emergency_contacts');
    }
};
