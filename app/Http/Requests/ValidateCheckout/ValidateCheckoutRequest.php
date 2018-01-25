<?php

namespace App\Http\Requests\ValidateCheckout;

use App\Http\Requests\Request;
use DB;

class ValidateCheckoutRequest extends Request{
    public function authorize(){
        return true;
    }

    public function rules(){
        $pincodes = DB::table('pincodes')->where('available_there','yes')->select('pincode')->get();
        $pincodearr = [];
        foreach($pincodes as $pincode){
            $pincodearr[] = $pincode->pincode;
        }
        
        $finalpincode = implode(',',$pincodearr);

        return [
            'productid' => 'required|numeric',
            'category'  => 'required',
            'quantity'  => 'required|numeric|min:1',
            'pincode'   => 'required|regex:/^[1-9][0-9]{5}$/|in:'.$finalpincode,
            'delivery_city' => 'required',
            'selectedDate' => 'required',
            'shippingtime' => 'required|in:standard_delivery,fix_time_delivery,mid_night_delivery,standard_time_delivery',
            'delivery_option' => 'required',
        ];
    }

    public function messages(){
        return[
            'quantity.required' => 'please input the required quantity',
            'pincode.required'           => 'please tell us your pincode',
            'pincode.regex'           => 'please enter a valid pincode',
            'pincode.in'           => 'Sorry this pincode is not available for delivery',
            'selectedDate.required' => 'Please select the date for delivery',
            'shippingtime.required' => 'please select delivery option',
            'delivery_option.required' => 'please tell us, when you want your product to be delivered',
        ];
    }
}
