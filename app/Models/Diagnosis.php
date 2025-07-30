<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
{
    use SoftDeletes;

    protected $table = 'tm_diagnosis';

    protected $fillable = [
        'name', 'clinic_id'
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime", 
        'deleted_at' => "datetime"
    ];
}
