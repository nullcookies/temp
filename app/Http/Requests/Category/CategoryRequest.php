<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Request;
use App\Category;
class CategoryRequest extends Request{
    public function authorize(){
        return true;
    }

    public function rules(){        
        return [
            'category' => 'required|unique:category',            
        ];
    }
    public function messages(){
        return [
            'category.required' => 'A Category is required',           
        ];
    }
}
