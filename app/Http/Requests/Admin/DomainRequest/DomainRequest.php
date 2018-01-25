<?php

namespace App\Http\Requests\Admin\DomainRequest;

use App\Http\Requests\Request;

class DomainRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'domain_name'       => 'required|url',
            'service_provider'  => 'required',
            'domain_user_id'    => 'required',
            'domain_password'   => 'required',
        ];
    }
}
