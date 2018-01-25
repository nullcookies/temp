<?php

namespace App\Http\Requests\DeliveryDetails;

use App\Http\Requests\Request;
use Auth, DB;

class DeliveryDetailsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $pincodes = DB::table('pincodes')->where('available_there','yes')->select('pincode')->get();
        $pincodearr = [];
        foreach($pincodes as $pincode){
            $pincodearr[] = $pincode->pincode;
        }
        
        $finalpincode = implode(',',$pincodearr);
        return [
            'shipping_name' => 'required',
            'shipping_email' => 'email',
            'shipping_state' => 'required',
            'shipping_city' => 'required',
            'shipping_address_line_1' => 'required',
            'shipping_pincode' => 'required|regex:/^[1-9][0-9]{5}$/|in:'.$finalpincode,
            'shipping_mobile' => 'required|regex:/^[789]\d{9}$/',
            'checkoutid' => 'required|numeric',
            'message' => 'required',
            'sender_name' => 'required',
            'sender_mobile' => 'required',
            'sender_email' => 'email',
        ];
    }

    public function messages(){
        if(Auth::user()){
          return ['shipping_name.required' => 'Select An Address',
            'shipping_email.email' => 'Select An Address',
            'shipping_state.required' => 'Select An Address',
            'shipping_city.required' => 'Select An Address',
            'shipping_address_line_1.required' => 'Select An Address',
            'shipping_pincode.required' => 'Select An Address',
            'shipping_pincode.regex' => 'Select An Address',
            'shipping_mobile.required' => 'Select An Address',
            'shipping_mobile.regex' => 'Select An Address',
            'checkoutid.required' => 'Please refresh the page',
            'sender_name.required' => 'please write the sender name',
            'sender_mobile.required' => 'please write sender mobile number',
            'sender_email.email' => 'please enter proper email'];

        }else{
            return [
                'shipping_name.required' => 'Please enter recipient name',
                'shipping_email.email' => 'Email should be in proper format',
                'shipping_state.required' => 'Please enter recipient state name',
                'shipping_state.required' => 'Please enter recipient city name',
                'shipping_address_line_1.required' => 'Please enter An Address',
                'shipping_pincode.required' => 'Select enter pincode',
                'shipping_pincode.regex' => 'enter a proper pincode',
                'shipping_mobile.required' => 'Please enter mobile number of recipient',
                'shipping_mobile.regex' => 'Please enter valid mobile number of recipient',
                'checkoutid.required' => 'Please refresh the page',
                'sender_name.required' => 'please write the sender name',
                'sender_mobile.required' => 'please write sender mobile number',
                'sender_email.email' => 'please enter proper email'
            ];
        }
    }
}
