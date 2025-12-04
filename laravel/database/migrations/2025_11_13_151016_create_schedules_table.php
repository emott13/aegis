<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->date('schedule_date');

            // All 7 employee references
            $table->unsignedBigInteger('made_by');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('care_red');
            $table->unsignedBigInteger('care_blue');
            $table->unsignedBigInteger('care_green');
            $table->unsignedBigInteger('care_yellow');

            $table->foreign('made_by')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('doctor_id')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('care_red')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('care_blue')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('care_green')->references('emp_id')->on('employees')->onDelete('cascade');
            $table->foreign('care_yellow')->references('emp_id')->on('employees')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
