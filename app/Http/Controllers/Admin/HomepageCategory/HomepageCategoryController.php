<?php

namespace App\Http\Controllers\Admin\HomepageCategory;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\HomepageCategory\AddHomepageCategoryRequest;
use App\Http\Requests, File, DB, Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomepageCategory\DeleteHomepageCategoryRequest;

class HomepageCategoryController extends Controller{
   	
   	public $data = [];
   	public function index(){

   		$this->data['items'] = DB::table('homepage_categories')->where('active','yes')->get();
   		return view('admin/homepage_category/index', $this->data);
   	}

   	public function store(AddHomepageCategoryRequest $request){
   		if(!$request->hasFile('file')){
    		return Redirect::back()->with('danger', 'Please upload a file');
    	}

    	$file = $request->file('file');

    	if(!in_array($file->getMimeType(), ['image/jpeg','image/png'])){
    		return Redirect::back()->with('danger', 'Please upload a jpeg,png file')->withInput($request->all());
    	}

    	if($file->getSize() > 2000000){
    		return Redirect::back()->with('danger', 'Please upload a file less than 2 mb size')->withInput($request->all());
    	}

    	if(!File::exists(public_path('/images/homepage_category'))){
    		File::makeDirectory(public_path('/images/homepage_category/'), 0775);
    	}

    	$destinationPath = public_path('/images/homepage_category');
    	$filename        = md5(uniqid(rand(), true)).'.'.$file->getClientOriginalExtension();

    	if(!$file->move($destinationPath,$filename)){
    		return Redirect::back()->with('danger', 'Unexpected Error, try again')->withInput($request->all());
    	}

    	$catalogueitemarray = [
    		'link'  => $request->link,
    		'image' => $filename,
    		'title' => $request->title,
    		'link_title' => $request->link_title,
    	];

    	$saveCatalogueItem = DB::table('homepage_categories')->insert($catalogueitemarray);

    	if(!$saveCatalogueItem){
    		return Redirect::back()->with('danger', 'An Unexpected Error occured, try again');
    	}

    	return Redirect::back()->with('success', 'Item Uploaded Successfully');
  	}

    public function delete(DeleteHomepageCategoryRequest $request){
      if(!is_array($request->id)){
        return Redirect::back()->with('delete-danger', 'An Unexpected Error occured, try again');
      }

      $delete = DB::table('homepage_categories')->whereIn('id',$request->id)->delete();

      if(!$delete){
        return Redirect::back()->with('delete-danger', 'An Unexpected Error occured, try again');
      }

      return Redirect::back()->with('delete-success', 'Banner(s) deleted Successfully');
    }
}
