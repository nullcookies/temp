<?php 

namespace App\Http\Requests\Coupon;

use App\Http\Requests\Request;
use DB;

class UpdateCouponRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){

		$requestArr 	=	 [
			'coupon_id'					 =>	'required|numeric',
			'coupon_name' 				 => 'required',
			'coupon_code'		         =>	'required',
			'coupon_type'				 =>	'required',
			'discount'					 =>	'required',
			'minimum_order_amt'		     =>	'required',
			'minimum_order_amt_type'	 =>	'required',
			'free_shipping'				 =>	'required',
			'start_date'				 =>	'required',
			'end_date'					 =>	'required',
			'per_coupon_limit'			 =>	'required',
			'per_user_limit'			 =>	'required',
			'description'				 =>	'required',
			'status'					 =>	'required',
		];

		return $requestArr;
	}
	public function messages(){
		return [	
		];
	}
}
