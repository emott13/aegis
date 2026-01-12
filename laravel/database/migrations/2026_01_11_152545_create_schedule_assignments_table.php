<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                             // Run the migrations.   
    {
        Schema::create(table: 'schedule_assignments', callback: function (Blueprint $table): void
        {
            $table  ->  id(column: 'assignment_id');

            $table  ->  string(column: 'shift', length: 10);
            $table  ->  string(column: 'role', length: 20);
            $table  ->  string(column: 'care_group', length: 10)
                    ->  nullable();

            $table  ->  foreignId(column: 'schedule_id')
                    ->  constrained(table: 'schedules', column: 'schedule_id');

            $table  ->  foreignId(column: 'emp_id')
                    ->  constrained(table: 'employees', column: 'emp_id');        

            $table  ->  timestamps();
            
            // handle checks via controller or form handler
            // ("shift IN ('morn','noon','eve','night')");
            // ("role IN ('doctor','supervisor','caregiver')");
            // ("care_group IN ('red','blue','green','yellow')");

            $table->unique(columns: ['schedule_id', 'emp_id']);
            $table->index(columns: 'emp_id');
        });
    }

    public function down(): void                                // Reverse the migrations.
    {
        Schema::dropIfExists(table: 'schedule_assignments');
    }
};
