<?php

namespace App\Http\Controllers\Massengers\Trackorder;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Orders\Orders;

class TrackorderController extends Controller{
    
    public function __construct(){
    }

    public function trackorder(Request $request){
    	return view('massengers/trackorder/trackorder');
    }
    
    public function orderstatus(Request $request){
        
        if(!$request->ajax()){
            exit;
        }
        
        
        if(!$request->has('email') || !$request->has('orderid')){
            echo 'Please Write email and orderid to track your order'; exit;
        }
        
        $order = Orders::where('id', $request->orderid)->where('customerEmail', $request->email)->first();
        
        if(!$order){
            echo 'The details does not match to our any order'; exit;
        }
        
        return view('massengers/trackorder/ajaxtrack',['order' => $order]);
    }
}
