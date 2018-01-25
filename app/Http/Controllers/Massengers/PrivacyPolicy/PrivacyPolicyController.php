<?php

namespace App\Http\Controllers\Massengers\PrivacyPolicy;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller{
    
    public function __construct(){}

    public function privacypolicy(Request $request){
    	return view('massengers/privacypolicy/privacypolicy');
    }
}
