<?php

namespace App\Http\Controllers\Massengers\Help;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HelpController extends Controller{
    
    public function __construct(){}

    public function help(Request $request){    	
    	return view('massengers/help/help');
    }
}
