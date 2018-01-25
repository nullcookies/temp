<?php

namespace App\Models\Trial;
use Eloquent;

class Trial extends Eloquent{
	public $timestamps = true;

	public function user(){
		return $this->belongsTo('App\User');
	}
}