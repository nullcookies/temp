<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'update_customer_name' 		=>  'required',
			'update_customer_mobile'	=>	'required|regex:/^\d{10}$/',
			'update_gender' 			=>	'required|in:male,female',
			'update_user_id'			=>	'required',
		];
	}
	public function messages(){
		return [
			'user_id'  => 'Cant process the query.Please Refresh the page and try again.',
		];
	}
}
