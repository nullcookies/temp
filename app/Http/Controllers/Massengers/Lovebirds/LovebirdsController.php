<?php

namespace App\Http\Controllers\Massengers\Lovebirds;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LovebirdsController extends Controller{
    
    public function __construct(){}

    public function lovebirds(Request $request){
    	return view('massengers/lovebirds/lovebirds');
    }
}
