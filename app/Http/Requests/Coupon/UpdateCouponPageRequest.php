<?php 

namespace App\Http\Requests\Coupon;
use App\Http\Requests\Request;

class UpdateCouponPageRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'c' 				 => 'required|numeric',
		];

		return $requestArr;
	}
	public function messages(){
		return [	
		];
	}
}
