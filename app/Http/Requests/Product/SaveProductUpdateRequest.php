<?php 

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use DB;

class SaveProductUpdateRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){
		$requestArr 	=	 [
			'product_name'		=>	'required',
			'product_desc'		=>	'required', //|min:250
			'product_sku'		=>	'required',
			'mrp'				=>	'required',
			'selling_price'		=>	'required',
			'product_quantity'	=>	'required',
			'dimension_lenght'	=>	'required|numeric',
			'dimension_width'	=>	'required|numeric',	
			'dimension_height'	=>	'required|numeric',
			'weight'			=>	'required|numeric',
			'category'			=>	'required',
			'product_id'		=>	'required|numeric',
		];

		return $requestArr;
	}
	public function messages(){
		return [	
			'dimension_lenght'	=>	'Please write correct dimension',
			'dimension_width'	=>	'Please write correct dimension',
			'dimension_height'	=> 	'Please write correct dimension',
		];
	}
}
