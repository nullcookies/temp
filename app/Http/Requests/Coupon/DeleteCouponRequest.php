<?php 

namespace App\Http\Requests\Coupon;
use App\Http\Requests\Request;
use DB;

class DeleteCouponRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){

		$requestArr 	=	 [
			'delete_coupon_id' 				 => 'required',
		];

		return $requestArr;
	}
	public function messages(){
		return [	
		];
	}
}
