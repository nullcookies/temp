<?php

namespace App\Http\Controllers\Admin\HomepageCategory;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\HomepageCategory\AddHomepageCategoryRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomepageCategoryController extends Controller{
   
   	public function index(){
   		return view('admin/homepage_category/index');
   	}

   	public function store(AddHomepageCategoryRequest $request){

  	}
}
