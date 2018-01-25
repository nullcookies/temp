<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class DeleteUserRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'user_id' => 'required|numeric',
		];
	}
	public function messages(){
		return [
			'user_id'  => 'Cant process the query.Please Refresh the page and try again.',
		];
	}
}
