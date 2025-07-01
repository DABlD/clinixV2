<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\UserAttribute;

use Hash;

class User extends Authenticatable
{
    use SoftDeletes, UserAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role', 'fname', 'mname', 'suffix',
        'lname', 'email', 'birthday', 
        'gender', 'address', 'contact', 
        'password', 'email_verified_at',
        'username',
        'clinic_id','tnc_agreement',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tnc-agreement' => 'datetime',
        'deleted_at' => 'datetime',
        'birthday' => 'datetime:Y-m-d',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function doctor(){
        return $this->hasOne('App\Models\Doctor');
    }

    public function clinic(){
        return $this->hasOne('App\Models\Clinic');
    }

    public function patient(){
        return $this->hasOne('App\Models\Patient');
    }
}