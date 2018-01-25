<?php

namespace App\Models\Varient;

use Illuminate\Database\Eloquent\Model;

class VarientType extends Model{

	public function values(){
		return $this->hasMany('App\Models\Varient\VarientTypeValue','varient_type_id');
	}
}
