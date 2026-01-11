<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                      // run the migrations
    {
        Schema::create(table: 'access_roles', callback: function (Blueprint $table): void 
        {
            $table->id(column: 'role_id');
            $table->string(column: 'role_name', length: 20)->unique();              // increase allows for growth

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'access_roles');
    }
};
