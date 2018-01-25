<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class SaveUserRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'user_name' 		=>  'required',
			'user_email'		=>	'required|email',
			'mobile_number'		=>	'required|regex:/^\d{10}$/',
			'password' 			=>	'required|min:6',
			'confirm_password'	=>	'required|same:password',
			'gender' 			=>	'required|in:male,female',
			'user_type'			=>	'required|in:customer,admin',
			'access_mode'		=>	'required|numeric',
		];
	}
	public function messages(){
		return [];
	}
}
