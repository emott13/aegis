<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void                                                      // run the migrations
    {
        Schema::create('access_roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 20)->unique();              // increase allows for growth

            $table->timestamps();
        });

        // -- Set starting ID for roles to 1000 -- //
        //
        // check the database driver
        // switch to set the sequence accordingly

        switch (DB::getDriverName()){
            case 'pgsql':                                                           // PostgreSQL
                DB::statement("ALTER SEQUENCE access_roles_role_id_seq RESTART WITH 1000;");
                break;
            case 'mysql':                                                           // MySQL
                DB::statement("ALTER TABLE access_roles AUTO_INCREMENT = 1000;");
                break;
            default:
                throw new RuntimeException(('Unsupported database driver: ' . DB::getDriverName()));
        }

        DB::statement("ALTER SEQUENCE access_roles_role_id_seq RESTART WITH 1000;"); // start IDs at 1000
        
    }

    public function down(): void
    {
        Schema::dropIfExists('access_roles');
    }
};
