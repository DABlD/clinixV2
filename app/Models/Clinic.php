<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ClinicAttribute;

class Clinic extends Model
{
    use SoftDeletes, ClinicAttribute;

    protected $fillable = [
        'user_id','name','location','region','contact','pf','logo','status'
    ];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\User');
    }
}
