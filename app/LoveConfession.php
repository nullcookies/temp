<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoveConfession extends Model{
    
    public function reply(){
        return $this->hasMany('App\LoveConfessionReply','lc_id');
    }
}
