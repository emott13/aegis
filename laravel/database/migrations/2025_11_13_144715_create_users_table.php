<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: 'users', callback: function (Blueprint $table): void 
        {
            $table  ->  id              (column: 'user_id');                        // COLUMN id
            $table  ->  string          (column: 'fname', length: 50);              // COLUMN first name
            $table  ->  string          (column: 'lname', length: 50);              // COLUMN last name
            $table  ->  string          (column: 'email')                           // COLUMN email
                    ->  unique          ();                                         //  (generates unique)
            $table  ->  string          (column: 'password');                       // COLUMN password
            $table  ->  string          (column: 'phone', length: 17)               // COLUMN phone num 15->(eg. +1-111-111-1111)
                    ->  nullable        ();                                         //  (allows NULL)
            $table  ->  date            (column: 'dob');                            // COLUMN date
            $table  ->  boolean         (column: 'approved')    
                    ->  default         (value: true);                              // COLUMN default true for testing

            $table  ->  foreignId       (column: 'role_id')                         // FKID
                    ->  constrained     (table: 'access_roles', column: 'role_id')  // CONSTRAINED
                    ->  onDelete        (action: 'cascade');                        // DELETES related parent--child records

            $table  ->  rememberToken   ();                                         // COLUMN remember token
            $table  ->  timestamps      ();                                         // COLUMN timestamps
        });
        
        // -- Set starting ID for users to 9000 -- //
        //
        // check the database driver
        // switch to set the sequence accordingly

        // switch (DB::getDriverName()){
        //     case 'pgsql':                                                           // PostgreSQL
        //         DB::statement
        //         (
        //             query: "ALTER SEQUENCE user_id_seq RESTART WITH 9000;"
        //         );
        //         break;
        //     case 'mysql':                                                           // MySQL
        //         DB::statement
        //         (
        //             query: "ALTER TABLE users AUTO_INCREMENT = 9000;"
        //         );
        //         break;
        //     default:
        //         throw new RuntimeException
        //         (
        //             message: ('Unsupported database driver: ' . DB::getDriverName())
        //         );
        // }
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'users');
    }
};
