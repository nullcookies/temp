<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Request;

class EditCategoryRequest extends Request
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
            'category' => 'required|unique:category',            
        ];
    }
    public function message()
    {
       return [
        'required' => 'Category not empty.'
       ];
    }
}
