<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                          // Run the migrations      
    {
        Schema::create(table: 'schedules', callback: function (Blueprint $table): void 
        {
            $table  ->  id(column: 'schedule_id');                                      // primary key
            $table  ->  date(column: 'schedule_date');                                  // date of schedule  

            $table  ->  foreignId(column: 'created_by')                                 // emp who made the schedule
                    ->  nullable()
                    ->  constrained(table: 'employees', column: 'emp_id');

            // All 7 employee references
        //     $table  ->  unsignedBigInteger(column: 'made_by');
        //     $table  ->  unsignedBigInteger(column: 'doctor_id');
        //     $table  ->  unsignedBigInteger(column: 'supervisor_id');
        //     $table  ->  unsignedBigInteger(column: 'care_red');
        //     $table  ->  unsignedBigInteger(column: 'care_blue');
        //     $table  ->  unsignedBigInteger(column: 'care_green');
        //     $table  ->  unsignedBigInteger(column: 'care_yellow');

        //     $table  ->  foreign(columns: 'made_by')
        //             ->  references(columns: 'emp_id')  
        //             ->  on(table: 'employees')   
        //             ->  onDelete(action: 'cascade');

        //     $table  ->  foreign(columns: 'doctor_id')  
        //             ->  references(columns: 'emp_id')  
        //             ->  on(table: 'employees')   
        //             ->  onDelete(action: 'cascade');

        //     $table  ->  foreign(columns: 'supervisor_id')  
        //             ->  references(columns: 'emp_id')  
        //             ->  on(table: 'employees')   
        //             ->  onDelete(action: 'cascade');  

        //     $table  ->  foreign(columns: 'care_red')
        //             ->  references(columns: 'emp_id')
        //             ->  on(table: 'employees')
        //             ->  onDelete(action: 'cascade');
            
        //     $table  ->  foreign(columns: 'care_blue')  
        //             ->  references(columns: 'emp_id')  
        //             ->  on(table: 'employees')
        //             ->  onDelete(action: 'cascade');
            
        //     $table  ->  foreign(columns: 'care_green')
        //             ->  references(columns: 'emp_id')
        //             ->  on(table: 'employees')
        //             ->  onDelete(action: 'cascade');
            
        //     $table  ->  foreign(columns: 'care_yellow')    
        //             ->  references(columns: 'emp_id')
        //             ->  on(table: 'employees')
        //             ->  onDelete(action: 'cascade');

            $table  ->  timestamps();                                                   // timestamps / created_at & updated_at  
        });
    }

    public function down(): void                                                        // Reverse the migrations
    {
        Schema::dropIfExists(table: 'schedules');
    }
};
