<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MHR extends Model
{
    protected $fillable = [
        'user_id', 'patient_id', 'qwa', 'backup',
    ];

    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime"
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }
}
