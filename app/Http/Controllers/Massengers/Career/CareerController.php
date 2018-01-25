<?php

namespace App\Http\Controllers\Massengers\Career;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CareerController extends Controller{
    
    public function __construct(){
    }

    public function career(Request $request){
    	return view('massengers/career/career');
    }
}
