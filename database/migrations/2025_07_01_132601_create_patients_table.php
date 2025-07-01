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
            $table->id();

            $table->unsignedInteger("user_id")->nullable();
            $table->string('patient_id')->nullable();

            $table->string('civil_status')->nullable();
            $table->string('birth_place')->nullable();

            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();

            $table->string('hmo_provider')->nullable();
            $table->string('hmo_number')->nullable();

            $table->string('employment_status')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_position')->nullable();
            $table->string('company_contact')->nullable();
            $table->string('sss')->nullable();
            $table->string('tin_number')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
