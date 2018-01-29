<?php

namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, DB;
use Redirect, Session, Mail, Validator, Response;
use App\Http\Requests\Admin\HomepageBanner\SaveBannerRequest;
use App\Http\Requests\Admin\HomepageBanner\DeleteBannerRequest;

class BannerController extends Controller{

	public $data = [];
	public function __construct(){
	}

	public function index(){
        $this->data['banners'] = DB::table('banner')->where('cid', 2)->where('status',1)->get();
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

    	$destinationPath = public_path('/images/banners/');
    	$filename        = md5(uniqid(rand(), true)).'.'.$file->getClientOriginalExtension();

    	if(!$file->move($destinationPath,$filename)){
    		return Redirect::back()->with('danger', 'Unexpected Error, try again')->withInput($request->all());
    	}

    	$catalogueitemarray = [
    		'cid' => '2',
    		'link'  => $request->link,
    		'image' => $filename,
    	];

    	$saveCatalogueItem = DB::table('banner')->insert($catalogueitemarray);

    	if(!$saveCatalogueItem){
    		return Redirect::back()->with('danger', 'An Unexpected Error occured, try again');
    	}

    	return Redirect::back()->with('success', 'Item Uploaded Successfully');
	}

    public function deleteBanner(DeleteBannerRequest $request){
        if(!is_array($request->bannerid)){
            return Redirect::back()->with('delete-danger', 'An Unexpected Error occured, try again');
        }

        $delete = DB::table('banner')->whereIn('id',$request->bannerid)->delete();

        if(!$delete){
            return Redirect::back()->with('delete-danger', 'An Unexpected Error occured, try again');
        }

        return Redirect::back()->with('delete-success', 'Banner(s) deleted Successfully');
    }
}
