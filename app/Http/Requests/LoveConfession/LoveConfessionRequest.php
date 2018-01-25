<?php

namespace App\Http\Requests\LoveConfession;

use App\Http\Requests\Request;

class LoveConfessionRequest extends Request{
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
    public function rules()
    {
        return [
            'login'    => 'required|in:loggedin',
            'confessor' => 'required',
            'message' => 'required',
            'confessing_to' => 'required',
            'mobile_number' => 'required|regex:/^[789]\d{9}$/',
        ];
    }
    
    public function messages(){
        return [
            'mobile_number.regex' => 'please fill correct mobile number',
            'login.required' => 'Please login first',
            'login.in' => 'Please login first',
        ];
    }
    
    
}
