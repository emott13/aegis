<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->string('phone', 10)->nullable();
            $table->boolean('approved')->default(false);
            $table->rememberToken();

            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('role_id')->on('access_roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
