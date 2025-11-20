<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SOAPRefraction extends Model
{
    protected $fillable = [
        "user_id",
        "patient_id",
        "va_sc_od",
        "va_sc_os",
        "va_ph_od",
        "va_ph_os",
        "va_cc_od",
        "va_cc_os",
        "va_spec_od",
        "va_spec_od_sp",
        "va_spec_od_cy",
        "va_spec_od_ax",
        "va_spec_os",
        "va_spec_os_sp",
        "va_spec_os_cy",
        "va_spec_os_ax",
        "ar_spec_od",
        "ar_spec_od_sp",
        "ar_spec_od_cy",
        "ar_spec_os",
        "ar_spec_os_sp",
        "ar_spec_os_cy",
        "nr_spec_od",
        "nr_spec_od_sp",
        "nr_spec_od_cy",
        "nr_spec_od_ax",
        "nr_spec_os",
        "nr_spec_os_sp",
        "nr_spec_os_cy",
        "nr_spec_os_ax",
        "nr_type_of_lens",
        "nr_type_of_frame",
        "ee_od_straight",
        "ee_od_up",
        "ee_od_down",
        "ee_od_mrd",
        "ee_od_lev_fxn",
        "ee_od_lid_crease",
        "ee_od_lid_lag"
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime"
    ];
}
