<?php

namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\Request;

class SaveNotificationRequest extends Request
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title'         => 'required|max:255',
            'product_desc'  => 'required',
            'type'          => 'required|in:notification,notice'
        ];
    }
}
