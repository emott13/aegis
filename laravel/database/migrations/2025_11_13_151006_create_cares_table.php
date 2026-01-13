<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                  // run the migrations
    {
        Schema::create(table: 'cares', callback: function (Blueprint $table): void 
        {
            $table  ->  id          (column: 'record_id');
            $table  ->  date        (column: 'care_date')
                    ->  default     (value: today());
                    
            $table  ->  boolean     (column: 'med_morn')
                    ->  nullable    ();
            $table  ->  boolean     (column: 'med_noon')
                    ->  nullable    ();
            $table  ->  boolean     (column: 'med_night')
                    ->  nullable    ();
            $table  ->  boolean     (column: 'breakfast')
                    ->  nullable    ();
            $table  ->  boolean     (column: 'lunch')
                    ->  nullable    ();
            $table  ->  boolean     (column: 'dinner')
                    ->  nullable    ();
            
            $table  ->  foreignId(column: 'patient_id')
                    ->  constrained(table: 'patients', column: 'patient_id')
                    ->  onDelete        (action: 'cascade');                            // DELETES related parent--child records

            $table  ->  foreignId(column: 'emp_id')
                    ->  constrained(table: 'employees', column: 'emp_id')
                    ->  onDelete        (action: 'cascade');                            // DELETES related parent--child records

            $table  ->  unique(columns: ['patient_id', 'care_date']);
        //             ->  unsigned();
        //     $table  ->  foreignId   (column: 'patient_id')->references(column: 'patient_id')
        //             ->  on          (table: 'patients')
        //             ->  onDelete    (action: 'cascade');
            $table  ->  rememberToken();
            $table  ->  timestamps();
        });
    }

    public function down(): void                                // reverse the migrations
    {
        Schema::dropIfExists(table: 'cares');
    }
};
