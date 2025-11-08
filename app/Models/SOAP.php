<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SOAP extends Model
{
    use SoftDeletes;

    protected $table = 'soaps';

    protected $fillable = [
        'clinic_id',
        'user_id',
        'patient_id',
        's_type_of_visit',
        's_chief_complaint',
        's_history_of_present_illness',
        'o_systolic',
        'o_diastolic',
        'o_pulse',
        'o_pulse_type',
        'o_temperature',
        'o_temperature_unit',
        'o_temperature_location',
        'o_respiration_rate',
        'o_respiration_type',
        'o_weight',
        'o_weight_unit',
        'o_height',
        'o_height_unit',
        'o_o2_sat',
        'o_drawing',
        'o_physical_examination',
        'a_previous_diagnosis',
        'a_diagnosis',
        'p_laboratory_requests',
        'p_imaging_requests',
        'p_diagnosis_care_plan',
        'p_previous_medication',
        'p_therapeutic_care_plan',
        'p_doctors_note',
        'p_files'
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime", 
        'deleted_at' => "datetime"
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }
}
