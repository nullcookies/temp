<?php

namespace App\Models\Varient;

use Illuminate\Database\Eloquent\Model;

class VarientTypeValue extends Model{
    
    public function selected(){
    	return $this->hasMany('App\Models\Varient\SelectedVarient','varient_type_value_id');
    }

    public static function getNotSelected($ids = array()){
    	return self::whereNotIn('id', $ids)->get();
    }
}
