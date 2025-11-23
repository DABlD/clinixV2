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
        Schema::create('s_o_a_p_refractions', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("soap_id");

            // VISUAL ACTIVITY
            $table->float('va_sc_od', 8,2)->nullable();
            $table->float('va_sc_os', 8,2)->nullable();
            $table->float('va_ph_od', 8,2)->nullable();
            $table->float('va_ph_os', 8,2)->nullable();
            $table->float('va_cc_od', 8,2)->nullable();
            $table->float('va_cc_os', 8,2)->nullable();

            $table->float('va_spec_od', 8,2)->nullable();
            $table->float('va_spec_od_sp', 8,2)->nullable();
            $table->float('va_spec_od_cy', 8,2)->nullable();
            $table->float('va_spec_od_ax', 8,2)->nullable();

            $table->float('va_spec_os', 8,2)->nullable();
            $table->float('va_spec_os_sp', 8,2)->nullable();
            $table->float('va_spec_os_cy', 8,2)->nullable();
            $table->float('va_spec_os_ax', 8,2)->nullable();

            // AUTO REFRACT
            $table->float('ar_spec_od', 8,2)->nullable();
            $table->float('ar_spec_od_sp', 8,2)->nullable();
            $table->float('ar_spec_od_cy', 8,2)->nullable();

            $table->float('ar_spec_os', 8,2)->nullable();
            $table->float('ar_spec_os_sp', 8,2)->nullable();
            $table->float('ar_spec_os_cy', 8,2)->nullable();

            // NEW REFRACT
            $table->float('nr_spec_od', 8,2)->nullable();
            $table->float('nr_spec_od_sp', 8,2)->nullable();
            $table->float('nr_spec_od_cy', 8,2)->nullable();
            $table->float('nr_spec_od_ax', 8,2)->nullable();
            $table->float('nr_spec_od_va', 8,2)->nullable();
            $table->float('nr_spec_od_pd', 8,2)->nullable();
            $table->float('nr_spec_od_sh', 8,2)->nullable();

            $table->float('nr_spec_os', 8,2)->nullable();
            $table->float('nr_spec_os_sp', 8,2)->nullable();
            $table->float('nr_spec_os_cy', 8,2)->nullable();
            $table->float('nr_spec_os_ax', 8,2)->nullable();
            $table->float('nr_spec_os_va', 8,2)->nullable();
            $table->float('nr_spec_os_pd', 8,2)->nullable();
            $table->float('nr_spec_os_sh', 8,2)->nullable();

            $table->float('nr_type_of_lens', 8,2)->nullable();
            $table->float('nr_type_of_frame', 8,2)->nullable();

            // EYELID EVALUATION
            $table->float('ee_od_straight', 8,2)->nullable();
            $table->float('ee_od_up', 8,2)->nullable();
            $table->float('ee_od_down', 8,2)->nullable();
            $table->float('ee_od_mrd', 8,2)->nullable();
            $table->float('ee_od_lev_fxn', 8,2)->nullable();
            $table->float('ee_od_lid_crease', 8,2)->nullable();
            $table->float('ee_od_lid_lag', 8,2)->nullable();

            $table->float('ee_os_straight', 8,2)->nullable();
            $table->float('ee_os_up', 8,2)->nullable();
            $table->float('ee_os_down', 8,2)->nullable();
            $table->float('ee_os_mrd', 8,2)->nullable();
            $table->float('ee_os_lev_fxn', 8,2)->nullable();
            $table->float('ee_os_lid_crease', 8,2)->nullable();
            $table->float('ee_os_lid_lag', 8,2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_o_a_p_refractions');
    }
};
