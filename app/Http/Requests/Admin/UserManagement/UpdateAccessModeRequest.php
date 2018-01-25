<?php 

namespace App\Http\Requests\Admin\UserManagement;

use App\Http\Requests\Request;

class UpdateAccessModeRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules()
	{
		return [
			'change_access_mode_user_id' => 'required|numeric',
			'new_access_mode'		     =>	'required|numeric',
		];
	}
	public function messages(){
		return [
			'user_id'  => 'Cant process the query.Please Refresh the page and try again.',
		];
	}
}
