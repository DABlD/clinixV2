<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistant extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id','sss','tin'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
