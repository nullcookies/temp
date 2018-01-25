<?php

namespace App\Http\Controllers\Massengers\Address;

use Illuminate\Http\Request;

use App\Http\Requests, Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressRequest;
use App\Http\Requests\Address\FetchAddressRequest;
use App\Models\Address\Address, Auth;

class AddressController extends Controller{
    
    public function __construct(){

    }

    public function savecustomeraddressajax(AddressRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}

    	if(!Auth::user()){
    		return Response::json(['message' => 'Please Login to add your address'],421);
    	}

    	foreach($request->all() as $key => $value){
    		$$key = $value;
    	}

    	$address = new Address;
    	$address->name = $name;
    	$address->email = $email;
    	$address->mobile = $mobile;
    	$address->city   = $city;
    	$address->state  = $state;
        $address->pincode = $pincode;
    	$address->country = "India";
    	$address->address = $address_line_1.','.$address_line_2;
    	$address->user_id  = Auth::user()->id;

    	if(!$address->save()){
    		return Response::json(['message' => 'An Unknown Error occured, try again..'],421);
    	}

    	return Response::json(['message' => 'success', 'success' => true],202);
    }

    public function fetchaddressajax(FetchAddressRequest $request){
        if(!$request->ajax()){
            exit;
        }

        if(!Auth::user()){
            exit;
        }

        $address = Address::where('user_id', Auth::user()->id)->where('id',$request->addressid)->first();

        if(!$address){
            return Response::json(['message' => 'Select A correct Address'],421);
        }

        return Response::json(['message' => 'success', 'success' => true, 'email' => $address->email , 'name' => $address->name, 'mobile' => $address->mobile, 'pincode' => $address->pincode, 'state' => $address->state, 'city' => $address->city, 'address' => $address->address],202);
    }
}
