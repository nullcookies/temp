<?php 

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use DB;

class ProductUpdateRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'c'		=>	'required|numeric',
		];

		return $requestArr;
	}
	public function messages(){
		return [];
	}
}
