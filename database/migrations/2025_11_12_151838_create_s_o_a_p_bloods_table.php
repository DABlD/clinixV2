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
        Schema::create('s_o_a_p_bloods', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("user_id");
            $table->string('patient_id');

            $table->string('value');
            $table->string('unit');
            $table->string('remarks');

            $table->datetime('datetime');

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
        Schema::dropIfExists('s_o_a_p_bloods');
    }
};