<?php

namespace App\Http\Controllers\Massengers\AboutUs;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller{
    
    public function __construct(){}

    public function aboutus(Request $request){
    	return view('massengers/aboutus/aboutus');
    }
}
