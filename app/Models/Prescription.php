<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        "user_id",
        "patient_id",
        "batch",
        "generic_name",
        "brand_name",
        "form",
        "qty",
        "instruction"
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime"
    ];
}
