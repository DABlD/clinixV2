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
        Schema::create('s_o_a_p_obgynes', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("user_id");
            $table->string('patient_id');

            // Dates
            $table->date('lmp')->nullable();
            $table->date('edc')->nullable();

            // Source of EDC (lmp or ultrasound)
            $table->enum('edc_source', ['lmp', 'ultrasound'])->nullable();

            // Measurements & Computed Values
            $table->string('aog', 40)->nullable();      // Age of gestation (e.g., "32w3d")
            $table->string('fh', 40)->nullable();       // Fundic height
            $table->string('fht', 40)->nullable();      // Fetal heart tone
            $table->text('ie')->nullable();             // Internal exam findings

            // Pregnancy history (GTPAL)
            $table->integer('gravida')->nullable();
            $table->integer('para')->nullable();
            $table->integer('term')->nullable();
            $table->integer('preterm')->nullable();
            $table->integer('abortion')->nullable();
            $table->integer('living')->nullable();

            // Other findings
            $table->string('presentation', 50)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('s_o_a_p_obgynes');
    }
};
