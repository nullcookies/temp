<?php

namespace App\Http\Requests\Admin\HomepageNav;

use App\Http\Requests\Request;

class DeleteHomepageNavRequest extends Request
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
            'navid' => 'required|numeric',
        ];
    }
}
