<?php

namespace App\Http\Controllers\Admin\Setting;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User, Auth, Redirect,Validator,Session;
use App\Models\Setting\BusinessDetail;
use App\Models\Setting\PickupDetail;
use App\Models\Setting\BankDetail;
use App\Models\DomainRequest\DomainRequest as DomainRequestModel;
use Illuminate\Support\Facades\Input;
use App\Models\Checklist\CheckList;

class SettingController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data    = array();
    }

    public function index(Request $request){

    	$data 		   =	$this->data; 
    	$data['businessDetail']	=	BusinessDetail::where('user_id', Auth::user()->id)->first();
    	$data['pickupDetail']	=	PickupDetail::where('user_id', Auth::user()->id)->first();
    	$data['bankDetail']		=	BankDetail::where('user_id', Auth::user()->id)->first();
    	$data['businessType']	=   $data['businessDetail'] ? $data['businessDetail']->type : '';
    	$data['account_type']	=	$data['bankDetail'] ? $data['bankDetail']->type : '';

        $data['domainRequests']   =   DomainRequestModel::where('user_id', Auth::user()->id)->get();
        
        $checklist = CheckList::first() ? CheckList::first() : new CheckList;

        if($data['businessDetail']){
            $checklist->business_details_checked = 'yes';
        }

        if($data['bankDetail']){
            $checklist->bank_details_checked = 'yes';
        }

        if(Auth::user()){
            $checklist->personal_details_checked = 'yes';
        }
        
        $checklist->save();
    	return view('admin/setting/setting', $data);
    }

    public function savePersonalInfo(Request $request){

    	if(!Auth::user()){
    		echo "you are not logged in";
    		exit;
    	}

    	foreach($request->all() as $key => $value){
    		$$key  = $value;
    	}

    	$user      = User::find(Auth::user()->id);

    	if(!$user){
    		echo "not correct user";
    		exit;
    	}

    	$user->name  		= $name;
    	$user->mobile 		= $mobile;
    	$user->website_name = $website_name;
    	$user->email 		= $email;
    	$user->city 		= $city;
    	$user->state 		= $state;

    	if(!$user->save()){
    		// do something
    	}	
    	
    	Session::flash('personal_detail',true);
    	return Redirect::back();
    }

    public function saveBusinessInfo(Request $request){

    	if(!Auth::user()){
    		echo "you are not logged in";
    		exit;
    	}

    	foreach($request->all() as $key => $value){
    		$$key  = $value;
    	}

    	$business_detail = BusinessDetail::where('user_id', Auth::user()->id)->first();

    	$business_detail = $business_detail ? $business_detail : new BusinessDetail;
    	
        if($request->hasFile('tin_proff')){
            $image = Input::file('tin_proff');
            $filename  = time() . uniqid() .'_tin.' . $image->getClientOriginalExtension();

            if(in_array($image->getClientOriginalExtension(), ['jpg','jpeg','png'])){
                $destination = public_path('/images');
                if($image->move($destination, $filename)){
                    $business_detail->uploaded_tin = 'yes';
                    $tin_proff = $filename;
                }
            }
        }

        if($request->hasFile('pan_proff')){
            $image1 = Input::file('pan_proff');
            $filename1  = time() . uniqid() .'_pan.' . $image1->getClientOriginalExtension();
            if(in_array($image1->getClientOriginalExtension(), ['jpg','jpeg','png'])){
                $destination = public_path('/images');
                if($image1->move($destination, $filename1)){
                    $business_detail->uploaded_pan = 'yes';
                    $pan_proff = $filename1;
                }
            }
        }
        
        if($request->hasFile('cst_proff')){
            $image1 = Input::file('cst_proff');
            $filename1  = time() . uniqid() .'_cst.' . $image1->getClientOriginalExtension();
            if(in_array($image1->getClientOriginalExtension(), ['jpg','jpeg','png'])){
                $destination = public_path('/images');
                if($image1->move($destination, $filename1)){
                    $business_detail->uploaded_cst = 'yes';
                    $cst_proff = $filename1;
                }
            }
        }

    	$business_detail->user_id  			 = Auth::user()->id;
    	$business_detail->company_legal_name = $company_legal_name;
    	$business_detail->city_registered    = $city_registered;
    	$business_detail->type               = $type;
    	$business_detail->address            = $address;
    	$business_detail->tin                = $tin;
    	$business_detail->pan                = $pan;
    	$business_detail->cst                = $cst;
        
        if(isset($tin_proff)){
            $business_detail->tin_proff          = url('images/'.$tin_proff);
        }
    	
        if(isset($pan_proff)){
            $business_detail->pan_proff          = url('images/'.$pan_proff);
        }
        
        if(isset($cst_proff)){
            $business_detail->cst_proff          = url('images/'.$cst_proff);
        }

    	if(!$business_detail->save()){
    		// do something
    	}
    	
    	Session::flash('business_detail',true);
    	return Redirect::back();
    }

    public function savePickupDetail(Request $request){
    	if(!Auth::user()){
    		echo "you are not logged in";
    		exit;
    	}

    	foreach($request->all() as $key => $value){
    		$$key  = $value;
    	}

    	$pickupDetail 		=	PickupDetail::where('user_id', Auth::user()->id)->first();

    	$pickupDetail 	    =   $pickupDetail ? $pickupDetail : new PickupDetail;

    	$pickupDetail->user_id 			= Auth::user()->id;
    	$pickupDetail->pickup_address 	= $pickup_address;
    	$pickupDetail->pickup_pincode   = $pickup_pincode;
    	$pickupDetail->pickup_mobile    = $pickup_mobile;
    	$pickupDetail->pickup_email     = $pickup_email;

    	if(!$pickupDetail->save()){
    		// do something
    	}

        Session::flash('pickup_detail',true);
    	return Redirect::back();
    }

    public function savebankDetails(Request $request){

    	if(!Auth::user()){
    		echo "you are not logged in";
    		exit;
    	}

    	foreach($request->all() as $key => $value){
    		$$key  = $value;
    	}

    	$bankDetail 	=	BankDetail::where('user_id', Auth::user()->id)->first();

    	$bankDetail     			=   $bankDetail ? $bankDetail : new BankDetail;
    	$bankDetail->user_id 		= 	Auth::user()->id;
    	$bankDetail->account_number = 	$account_number;
    	$bankDetail->type 			=	$type;
    	$bankDetail->bank_name 		= 	$bank_name;
    	$bankDetail->ifsc_code 		= 	$ifsc_code;
    	
    	if(!$bankDetail->save()){
    		// do something 
    	}
    
        Session::flash('bank_detail',true);
    	return Redirect::back();
    }


    /* Image JCrop */
    public function imageform()    {
       return view('admin/jcrop/imageform');
    }

    public function postimageform(Request $request){
       $rules = array(
            'image' => 'required|mimes:jpeg,jpg|max:10000'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()){
            return Redirect::to('admin/imageform')->withErrors($validation);
        }else{
            $file = Input::file('image');
            $file_name = $file->getClientOriginalName();
            if ($file->move('images', $file_name)){
                return Redirect::to('admin/jcrop')->with('image',$file_name);
            }else{
                return "Error uploading file";
            }
        }
    }
    public function jcrop()    {

    $data = array();
    $data['image'] = url('images/slider2.jpg');
    //dd($data);
       return view('admin/jcrop/jcrop', $data);
    }
    public function postjcrop(Request $request){
        $quality = 90;

        $src  = Input::get('image');
        $img  = imagecreatefromjpeg($src);
        $dest = ImageCreateTrueColor(Input::get('w'),
            Input::get('h'));

        imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
            Input::get('y'), Input::get('w'), Input::get('h'),
            Input::get('w'), Input::get('h'));
        imagejpeg($dest, $src, $quality);

        return "<img src='" . $src . "'>";
    }
}
