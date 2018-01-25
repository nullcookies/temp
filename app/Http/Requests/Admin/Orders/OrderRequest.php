<?php

namespace App\Http\Requests\Admin\Orders;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
        return [
              "productSearch"   => "required",
              "price"           => "required|numeric",
              "customerName"    => "required|min:3",
          //For Duplicate Email validation   // "customerEmail"   => "required|email|unique:orders,customerEmail",
              "customerEmail"   => "required",
              "customerPhone"  => "required",
              "customerAddress" => "required",
              "customerState"   => "required",
              "customerCity"    => "required",
              "customerPostCode" => "required|regex:/\b\d{6}\b/",             
              "productCode"     => "required",
              "productName"     => "required",

        ];
    }

}
