<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\Request;

class AddressRequest extends Request{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'required',
            'email' => 'email',
            'city' => 'required',
            'state' => 'required',
            'address_line_1' => 'required',
            'pincode' => 'required|regex:/^[1-9][0-9]{5}$/',
            'mobile' => 'required|regex:/^[789]\d{9}$/',
        ];
    }

    public function messages(){
        return [
            'address_line_1.required' => 'Write down a address',
            'mobile.regex' => 'write down a proper mobile number',
            'pincode.in' => 'We do not deliver products to this pincode',
        ];
    }
}
