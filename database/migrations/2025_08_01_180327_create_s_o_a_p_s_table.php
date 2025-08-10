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
        Schema::create('soaps', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("clinic_id")->nullable();
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("patient_id")->nullable();

            $table->string('s_type_of_visit')->nullable();
            $table->string('s_chief_complaint')->nullable();
            $table->string('s_history_of_present_illness')->nullable();
            
            $table->string('o_systolic')->nullable();
            $table->string('o_diastolic')->nullable();
            $table->string('o_pulse')->nullable();
            $table->string('o_pulse_type')->nullable();
            $table->string('o_temperature')->nullable();
            $table->string('o_temperature_unit')->nullable();
            $table->string('o_temperature_location')->nullable();
            $table->string('o_respiration_rate')->nullable();
            $table->string('o_respiration_type')->nullable();
            $table->string('o_weight')->nullable();
            $table->string('o_weight_unit')->nullable();
            $table->string('o_height')->nullable();
            $table->string('o_height_unit')->nullable();
            $table->string('o_o2_sat')->nullable();
            $table->string('o_drawing')->nullable();
            $table->text('o_physical_examination')->nullable();

            $table->string('a_previous_diagnosis')->nullable();
            $table->string('a_diagnosis')->nullable();

            $table->string('p_laboratory_requests')->nullable();
            $table->string('p_imaging_requests')->nullable();
            $table->string('p_diagnosis_care_plan')->nullable();
            $table->string('p_previous_medication')->nullable();
            $table->string('p_therapeutic_care_plan')->nullable();
            $table->string('p_doctors_note')->nullable();

            $table->text('p_files')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soaps');
    }
};
