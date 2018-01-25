<?php

namespace App\Http\Controllers\Massengers\Needtoday;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NeedtodayController extends Controller{
 	
 	public function __construct(){
 	}

 	public function needtoday(Request $request){
 		return view('massengers/needtoday/needtoday');
 	}
}
