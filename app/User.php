<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Social;

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','user_gender','user_type','authority','is_rm',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany('App\Models\Orders\Orders','customerEmail','email')->orderBy('created_at','desc');
    }
    
    public function social(){
        return $this->hasOne('App\Models\Social');
    }
    
    public function addresses(){
        return $this->hasMany('App\Models\Address\Address','user_id');
    }
}
