<?php

namespace App\Http\Controllers\Admin\DomainRequest;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DomainRequest\DomainRequest;
use App\Models\DomainRequest\DomainRequest as DomainRequestModel;
use Session, Auth, Redirect, Response;

class DomainRequestController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data 		=	array();
    }

    public function index(Request $requets){

    	$this->data['domainRequests']	=	DomainRequestModel::join('users','users.id','=','domain_request.user_id')->select('domain_request.id','domain_request.domain_name','users.name as customer_name','users.email','users.mobile','domain_request.service_provider','domain_request.user_name','domain_request.password','domain_request.status','domain_request.created_at')->get();
    	return view('admin/domain_request/domain_request', $this->data);
    }

    public function create(DomainRequest $request){  // setting module domain request send functionality

    	if(!Auth::user()){
    		echo 'please login first';
    		exit;
    	}

    	$domainRequest 						=	new DomainRequestModel;
    	$domainRequest->user_id				=	Auth::user()->id;
    	$domainRequest->domain_name 		=	$request->domain_name;
    	$domainRequest->service_provider	=	$request->service_provider;
    	$domainRequest->user_name 			=	$request->domain_user_id;
    	$domainRequest->password 			=	$request->domain_password;

    	$message 							=	'domain request successfully placed';
    	$class 								=	'success';
    	if(!$domainRequest->save()){
    		$message 						=	'Cant saved domain details';
    		$class 							=	'danger';
    	}

    	Session::flash('message', $message);
    	Session::flash('class', $class);
    	Session::flash('domain_setup_request', true);

    	return Redirect::back();
    }

    public function change_status_ajax(Request $request){

        if(!$request->ajax()){
            echo 'bad request0';
            exit;
        }

        if(!$request->has('requestid') || !$request->has('status')){
            echo 'invalid parameters';
            exit;
        }

        if(!in_array($request->status, ['pending','completed'])){
            echo 'invalid data';
            exit;
        }

        $domainRequest          =   DomainRequestModel::where('id',$request->requestid)->first();

        if(!$domainRequest){
            echo 'data not exist'; 
            exit;
        }

        $domainRequest->status  =   $request->status;

        if(!$domainRequest->save()){
            return Response::json(array('fail' => true, 'message' => 'Cant saved the data'));
            exit;
        }

        return Response::json(array('success' => true, 'message' => 'saved successfully'));
        exit;
    }
}
