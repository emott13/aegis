<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                  // run the migration
    {
        Schema::create(table: 'appointments', callback: function (Blueprint $table): void 
        {
            $table  ->  id              (column: 'appt_id');
            $table  ->  datetime        (column: 'appt_date');

            $table  ->  bigInteger      (column: 'patient_id')
                    ->  unsigned        ();
            $table  ->  bigInteger      (column: 'doctor_id')   
                    ->  unsigned        ();
            $table  ->  string          (column: 'doc_comment') 
                    ->  nullable        ();
            $table  ->  foreign         (columns: 'patient_id')
                    ->  references      (columns: 'patient_id')
                    ->  on              (table: 'patients')
                    ->  onDelete        (action: 'cascade');
            $table  ->  foreign         (columns: 'doctor_id')
                    ->  references      (columns: 'emp_id')
                    ->  on              (table: 'employees')
                    ->  onDelete        (action: 'cascade');

            $table  ->  rememberToken   ();
            $table  ->  timestamps      ();
        });
    }

    public function down(): void                                                // reverse the migration
    {
        Schema::dropIfExists(table: 'appointments');
    }
};
