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
        Schema::create('cares', function (Blueprint $table) {
            $table->id('record_id');
            $table->boolean('med_morn')->nullable();
            $table->boolean('med_noon')->nullable();
            $table->boolean('med_night')->nullable();
            $table->boolean('breakfast')->nullable();
            $table->boolean('lunch')->nullable();
            $table->boolean('dinner')->nullable();
            $table->date('care_date');
            
            $table->bigInteger('emp_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->foreign('patient_id')->references('patient_id')->on('patients');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cares');
    }
};
