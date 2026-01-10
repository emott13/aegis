<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void                                              // run the migrations
    {
        Schema::create(table: 'employees', callback: function (Blueprint $table): void 
        {
            $table  ->  id              (column: 'emp_id');                 // COLUMN id            (AI)
            $table  ->  date            (column: 'hire_date');              // COLUMN date          (mm-dd-YY format??)
            $table  ->  integer         (column: 'salary')
                    ->  nullable        ();                                 // COLUMN annual salary (set range in file:)

            $table  ->  foreignId       (column: 'user_id')                             // FKID
                    ->  constrained     (table: 'users', column: 'user_id')             // CONSTRAINED
                    ->  onDelete        (action: 'cascade');                            // DELETES related parent--child records

            $table  ->  rememberToken   ();
            $table  ->  timestamps      ();                                 // COLUMN timestamps
        });
    }

    public function down(): void                                            // reverse the migrations
    {
        Schema::dropIfExists(table: 'employees');
    }
};
