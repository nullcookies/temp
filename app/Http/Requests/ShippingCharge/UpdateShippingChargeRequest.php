<?php 

namespace App\Http\Requests\ShippingCharge;

use App\Http\Requests\Request;
use DB;

class UpdateShippingChargeRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'new_zone_name' 				 => 'required',
			'new_zone_id'					 =>	'required',
		];

		$weights       					 =   DB::table('delivery_weight')->get();
		
		foreach($weights as $weight) {
			$requestArr['new_'.$weight->weight_in_gms] = 'required|numeric';
		}

		foreach($weights as $weight) {
			$requestArr[$weight->weight_in_gms.'_id'] = 'required|numeric';
		}
		return $requestArr;
	}
	public function messages(){
		return [	
		];
	}
}
