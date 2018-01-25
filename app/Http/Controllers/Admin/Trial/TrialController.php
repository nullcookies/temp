<?php

namespace App\Http\Controllers\Admin\Trial;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trial\Trial;

class TrialController extends Controller{
    
    public function __construct(){}

    public function showList(Request $request){
    	return view('admin/trial/list');
    }

    public function getlist(Request $request){
    	$data 			=	array();
    	$trials   		= Trial::where('deleted','no')->paginate(15);
    	$count 			= $trials ? $trials->lastPage() : 0;
    	foreach($trials as $key => $trial){
    		$data['trials'][$key]['id']  				= $trial->id;
    		$data['trials'][$key]['subdomain'] 			= $trial->subdomain;
    		$data['trials'][$key]['status']    			= $trial->status;
    		$data['trials'][$key]['created_subdomain']	= $trial->created_subdomain;
    		$data['trials'][$key]['created_a_record']		= $trial->created_a_record;
    		$data['trials'][$key]['created_database']		= $trial->created_database;
    		$data['trials'][$key]['added_user_to_db']		= $trial->added_user_to_db;
    		$data['trials'][$key]['step']					= $trial->step;
    		$data['trials'][$key]['username'] 			= $trial->user->name;
    		$data['trials'][$key]['email'] 				= $trial->user->email;
    		$data['trials'][$key]['mobile'] 				= $trial->user->mobile;
    	}
    	
    	$data['count'] = $count;
    	return response($data);
    }

    public function deleteTrial(Request $request){
    	if(!$request->has('id')){
    		return response(array('fail' => true, 'message' => 'invalid parameetr'));
    		exit;
    	}

    	$trial 			=	Trial::find($request->id);
    	$trial->deleted =   'yes';
    	
    	if(!$trial->save()){
    		return response(array('fail' => true,'message' => 'Some Problem ocured'));
    		exit;
    	}
    	return response(array('success' => true,'message' => 'Successfully deleted'));
    }
}
