<?php 

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use DB;

class BulkUploadRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'product_csv'		=>	'required',
			'category' 			=>	'required',
		];

		return $requestArr;
	}
	public function messages(){
		return [];
	}
}
