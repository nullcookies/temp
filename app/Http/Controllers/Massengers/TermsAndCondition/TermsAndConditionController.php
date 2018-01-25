<?php

namespace App\Http\Controllers\Massengers\TermsAndCondition;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TermsAndConditionController extends Controller{
    
    public function __construct(){}

    public function termsandconditions(Request $request){
    	return view('massengers/termsandconditions/termsandconditions');
    }
}
