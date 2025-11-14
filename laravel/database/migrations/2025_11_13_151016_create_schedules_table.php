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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->date('schedule_date');

            $table->bigInteger('made_by')->unsigned();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('supervisor_id')->unsigned();
            $table->bigInteger('care_red')->unsigned();
            $table->bigInteger('care_blue')->unsigned();
            $table->bigInteger('care_green')->unsigned();
            $table->bigInteger('care_yellow')->unsigned();
            $table->foreign('made_by')->references('emp_id')->on('employees');
            $table->foreign('doctor_id')->references('emp_id')->on('employees');
            $table->foreign('supervisor_id')->references('emp_id')->on('employees');
            $table->foreign('care_red')->references('emp_id')->on('employees');
            $table->foreign('care_blue')->references('emp_id')->on('employees');
            $table->foreign('care_green')->references('emp_id')->on('employees');
            $table->foreign('care_yellow')->references('emp_id')->on('employees');
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
