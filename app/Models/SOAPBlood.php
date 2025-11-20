<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SOAPBlood extends Model
{
    protected $fillable = [
        "user_id",
        "patient_id",
        "value",
        "unit",
        "remarks",
        "datetime"
    ];

    protected $casts = [
        'created_at' => "datetime",
        'updated_at' => "datetime",
        'datetime' => "datetime"
    ];
}