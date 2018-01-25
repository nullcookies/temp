<?php

namespace App\Http\Requests\Admin\Banners;

use App\Http\Requests\Request;

class BannerRequest extends Request
{
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
             'image'  => 'required|image|mimes:jpeg,png,jpg|max:2056',
             'link'    => 'url',
             'category' => 'required',
        ];
    }
	public function messages(){
        return [
            'max' => 'Maximum upload file size: 2MB.',
        ];
    }
    
}
