<?php

namespace App\Http\Controllers\Massengers\Loversmantra;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoversmantraController extends Controller{
    
    public function __construct(){}

    public function loversmantra(Request $request){
    	return view('massengers/loversmantra/loversmantra');
    }
}
