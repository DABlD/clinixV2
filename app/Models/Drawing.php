<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drawing extends Model
{
    use SoftDeletes;

    protected $table = 'tm_drawings';

    protected $fillable = [
        'clinic_id', 'name', 'specialization', 'image'
    ];
    
    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime", 
        'deleted_at' => "datetime"
    ];
}
