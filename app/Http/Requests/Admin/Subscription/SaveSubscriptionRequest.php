<?php

namespace App\Http\Requests\Admin\Subscription;

use App\Http\Requests\Request;
use App\Models\Subscription\Themes;
use App\Models\Subscription\Plans;
use App\Models\Subscription\TimeSlot;

class SaveSubscriptionRequest extends Request
{
    public function authorize(){
        return true;
    }

    public function rules(){
        $themes             =   Themes::getCommSeperateId();
        $plans              =   Plans::getCommSeperateId();
        return [
            'theme'         =>  'required|in:'.$themes,
            'plan'          =>  'required|in:'.$plans,
            'time_slot'     =>  'required',
            'total_amt'     =>  'required|numeric',
            'name'          =>  'required',
            'email'         =>  'required',
            'phone'         =>  'required',
            'street_address'=>  'required',
            'city'          =>  'required',
            'country'       =>  'required',
            'state'         =>  'required',
            'payment_mode'  =>  'required',
            'zipcode'       =>  'required|numeric'
        ];
    }
}
