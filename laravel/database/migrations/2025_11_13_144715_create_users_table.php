<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table  ->  id              ('user_id')                             ;         // COLUMN id

            $table  ->  string          ('fname', 50)                           ;         // COLUMN first name
            $table  ->  string          ('lname', 50)                           ;         // COLUMN last name
            $table  ->  string          ('email')       ->  unique      ()      ;         // COLUMN email (generates unique)
            $table  ->  string          ('password')                            ;         // COLUMN password
            $table  ->  string          ('phone', 10)   ->  nullable    ()      ;         // COLUMN 10-digit phone num, allows NULL

            $table  ->  date            ('dob')                                 ;         // COLUMN date

            $table  ->  boolean         ('approved')    ->  default     (true)  ;         // COLUMN default true for testing
            
            $table  ->  rememberToken   ()                                      ;

            $table  ->  bigInteger      ('role_id')     ->  unsigned    ()      ;         // COLUMN role_id
            $table  ->  foreignId       ('role_id')                                         // FKID
                    ->  constrained     ('access_roles', 'role_id')                         // CONSTRAINED
                    ->  onDelete        ('cascade')                             ;         // DELETES related parent -- child records
            $table  ->  timestamps      ()                                      ;         // COLUMN timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
