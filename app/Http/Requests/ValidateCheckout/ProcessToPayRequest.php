<?php

namespace App\Http\Requests\ValidateCheckout;

use App\Http\Requests\Request;

class ProcessToPayRequest extends Request{
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
            'checkoutid'      => 'required',
            'term_conditions' => 'required',
        ];
    }

    public function messages(){
        return [
            'checkoutid.required' => 'please reload the page and try again',
            'term_conditions.required' => 'Please do agree term and conditions first..!'
        ];
    }
}
