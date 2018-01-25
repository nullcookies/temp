<?php 

namespace App\Http\Requests\ShippingCharge;
use App\Http\Requests\Request;

class UpdatePincodeRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		return [
			'zone' 				 		 => 'required',
			'pincode_csv'		     	 =>	'required',
		];
	}

	public function messages(){
		return [	
		];
	}
}
