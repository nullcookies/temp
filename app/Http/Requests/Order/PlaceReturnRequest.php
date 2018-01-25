<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class PlaceReturnRequest extends Request
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'reason' => 'required',
        ];
    }
}
