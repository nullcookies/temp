<?php

namespace App\Http\Requests\Cart;

use App\Http\Requests\Request;

class AddCartItemRequest extends Request{
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
            'productid' => 'required|numeric',
            'category'  => 'required',
            'quantity'  => 'required|numeric|min:1',
            'selectedDate' => 'required',
            'shippingtime' => 'required|in:standard_delivery,fixtime_delivery,mid_night_delivery',
            'delivery_option' => 'required',
        ];
    }

    public function messages(){
        return [
            'productid.required' => 'please refresh the page and try again',
            'auth.required' => 'You have to login first',
            'auth.in' => 'You have to login first',
            'category.required' => 'please refresh the page and try again',
            'productid.numeric' => 'please refresh the page and try again',
            'selectedDate.required' => 'Please select the date for delivery',
            'shippingtime.required' => 'please select delivery option',
            'delivery_option.required' => 'please tell us, when you want your product to be delivered',
        ];
    }
}
