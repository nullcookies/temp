<?php

namespace App\Http\Controllers\Massengers\Disclaimer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisclaimerController extends Controller{
    
    public function __construct(){}

    public function disclaimer(Request $request){
    	return view('massengers/disclaimer/disclaimer');
    }
}
