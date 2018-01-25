<?php

namespace App\Http\Controllers\Helper;
use App\Http\Controllers\Controller;

class HelperController{
    
    public function __construct(){
    }

    public static function validateDate($date){
	    $d = \DateTime::createFromFormat('Y-m-d', $date);
	    return $d && $d->format('Y-m-d') ? $d->format('Y-m-d') : false;
	}
}
