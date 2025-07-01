<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\PatientAttribute;

class Patient extends Model
{
    use SoftDeletes, PatientAttribute;

    protected $filalble = [
        'user_id',
        'patient_id',
        'civil_status',
        'birth_place',
        'nationality',
        'religion',
        'hmo_provider',
        'hmo_number',
        'employment_status',
        'company_name',
        'company_position',
        'company_contact',
        'sss',
        'tin_number'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function clinic(){
        return $this->belongsTo('App\Models\Clinic');
    }
}
