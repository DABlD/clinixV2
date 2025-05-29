<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','name','location','region','contact','pf','logo'
    ];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\User');
    }
}
