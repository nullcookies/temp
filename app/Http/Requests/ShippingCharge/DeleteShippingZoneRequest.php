<?php 

namespace App\Http\Requests\ShippingCharge;

use App\Http\Requests\Request;


class DeleteShippingZoneRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		return	 [
			'delete_zone_id' 				 => 'required',
		];
	}
	public function messages(){
		return [	
		];
	}
}
