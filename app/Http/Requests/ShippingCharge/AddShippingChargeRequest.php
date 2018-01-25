<?php 

namespace App\Http\Requests\ShippingCharge;

use App\Http\Requests\Request;
use DB;

class AddShippingChargeRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'zone_name' 				 => 'required',
			'pincodes'		     		 =>	'required',
		];

		$weights       					 =   DB::table('delivery_weight')->get();
		
		foreach($weights as $weight) {
			$requestArr[$weight->weight_in_gms.'_gms'] = 'required';
		}

		return $requestArr;
	}
	public function messages(){
		return [	
		];
	}
}
