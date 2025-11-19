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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('family_code', 20)->nullable();
            $table->string('em_fname', 50)->nullable();
            $table->string('em_lname', 50)->nullable();
            $table->string('em_phone', 10)->nullable();
            $table->string('em_relation', 20)->nullable();
            $table->date('admission_date');
            $table->enum('care_group', array('red', 'blue', 'green', 'yellow'))->nullable();
            $table->string('med_morn', 50)->nullable();
            $table->string('med_noon', 50)->nullable();
            $table->string('med_night', 50)->nullable();
            $table->integer('bill_amount')->default(0);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
