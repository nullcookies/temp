<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'user_id' 			=>  'required|numeric',
			'new_password'		=>	'required|min:6',
			'repeat_password'	=>	'required|same:new_password',
		];
	}
	public function messages(){
		return [
			'user_id'  			=> 'Cant process the query.Please Refresh the page and try again.',
			'new_password'		=> 'Enter new password',
			'repeat_password'	=> 'This should be same as new password',
		];
	}
}
