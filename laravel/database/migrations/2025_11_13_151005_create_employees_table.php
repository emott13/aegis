<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table  ->  id                  ('emp_id')                          ;   // COLUMN id            (AI)
            $table  ->  date                ('hire_date')                       ;   // COLUMN date          (mm-dd-YY format??)
            $table  ->  integer             ('salary')      ->  nullable    ()  ;   // COLUMN annual salary (set range in file:)

            $table  ->  unsignedBigInteger  ('user_id')                         ;   // COLUMN user id       (foreign key user id)
            $table  ->  foreignId           ('user_id')
                    ->  constrained         ('employees', 'user_id')
                    ->  onDelete            ('cascade')                         ;   // DELETE parent -- child related records

            $table  ->  timestamps          ()                                  ;   // COLUMN timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
