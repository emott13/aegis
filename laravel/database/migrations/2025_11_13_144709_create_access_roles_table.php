<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 20)->unique();               // increase allows for growth
            $table->timestamps();
        });

        DB::statement(                                              // postgresql -- start IDs at 1000
            "
            ALTER TABLE access_roles
            ALTER COLUMN role_id RESTART WITH 1000
            "
        );
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_roles');
    }
};
