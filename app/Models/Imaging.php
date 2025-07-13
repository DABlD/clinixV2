<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imaging extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'sss',
        'tin',
        'philhealth',
        'pagibig'
    ];

    protected $casts = [
        'created_at' => "datetime", 
        'updated_at' => "datetime", 
        'deleted_at' => "datetime"
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
