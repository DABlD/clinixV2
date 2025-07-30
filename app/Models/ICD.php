<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ICD extends Model
{
    use SoftDeletes;

    protected $table = 'tm_icd';

    protected $fillable = [
        'clinic_id', 'code', 'block', 'description'
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime", 
        'deleted_at' => "datetime"
    ];
}
