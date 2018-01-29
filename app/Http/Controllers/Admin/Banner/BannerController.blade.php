<?php

namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, DB;
use Redirect, Session, Mail, Validator, Response;
use App\Http\Requests\Admin\HomepageBanner\SaveBannerRequest;

class BannerController extends Controller{

	public $data = [];
	public function __construct(){
	}

	public function index(){
		return view('admin/banners/index', $this->data);
	}


	public function saveBanner(SaveBannerRequest $request){
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

    	$destinationPath = public_path('/images/catalogue/');
    	$filename        = md5(uniqid(rand(), true)).'.'.$file->getClientOriginalExtension();

    	if(!$file->move($destinationPath,$filename)){
    		return Redirect::back()->with('danger', 'Unexpected Error, try again')->withInput($request->all());
    	}

    	$catalogueitemarray = [
    		'cid' => '2',
    		'link'  => $request->link,
    		'catalogueid' => $request->album,
    		'image' => $filename,
    	];

    	$saveCatalogueItem = DB($catalogueitemarray);

    	if(!$saveCatalogueItem){
    		return Redirect::back()->with('danger', 'An Unexpected Error occured, try again');
    	}

    	return Redirect::back()->with('success', 'Item Uploaded Successfully');
	}
}
