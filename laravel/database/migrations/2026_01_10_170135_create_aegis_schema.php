<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void                                      // run the migrations
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS aegis');
    }

    public function down(): void                                    // reverse the migrations
    {
        DB::statement('DROP SCHEMA IF EXISTS aegis CASCADE');
    }
};
