<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class UpdateUserTypeRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'new_user_type' 				=>  'required|in:customer,admin',
			'change_user_type_user_id'	=>	'required',
		];
	}
	public function messages(){
		return [
			'user_id'  => 'Cant process the query.Please Refresh the page and try again.',
		];
	}
}
