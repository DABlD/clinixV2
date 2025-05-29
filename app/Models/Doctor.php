<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','title','specialization','license_number','e_signature'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
