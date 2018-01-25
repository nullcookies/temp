<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model{
    
    public function timings(){
        return $this->hasMany('App\DeliveryTiming','delivery_method_id');
    }
}
