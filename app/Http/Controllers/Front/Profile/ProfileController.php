<?php

namespace App\Http\Controllers\Front\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller{
    
    public function listAddress(Request $request){    
    	return view('front/user/listaddress');
    }

    public function saveAddress(Request $request){
    	return view('front/user/saveaddress');
    }

    public function changepassword(Request $request){
    	return view('front/user/changepassword');
    }
}
