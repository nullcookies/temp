<?php

namespace App\Http\Controllers\Admin\RelationshipManager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User, Response;
use App\Models\Subscription\Subscription;

class RelationshipManagerController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data = array();
    }

    public function create(Request $request){

    	$this->data['show'] 	=	false;
    	if($request->has('q')){
    		$this->data['show'] 			  =	true;
    		$searchVar          			  =   $request->q;
            $this->data['users']              =   User::where(function($query) use ($searchVar){
                $query->where('name','like','%'.$searchVar.'%');
                $query->orWhere('mobile','like','%'.$searchVar.'%');
                $query->orWhere('email','like','%'.$searchVar.'%');
            });

            $this->data['users'] 			  =	$this->data['users']->where('user_type','admin')->select('id','name','mobile','email')->get();

            foreach($this->data['users'] as $user){
            	$this->data['isRm']			  =	User::where('id', $user->id)->where('is_rm','yes')->first();
            }
    	}
    	
    	return view('admin/relationship_manager/create', $this->data);
    }

    public function makeRmAjax(Request $request){

    	if(!$request->ajax()){
    		return Response::json(array('fail' => 1,'message'=>'unauthorised'));
    		exit;
    	}

    	if(!$request->has('userid')){
    		return Response::json(array('fail' => 1, 'message' => 'unauthorised'));
    		exit;
    	}

    	$user 				=	User::where('id', $request->userid)->where('user_type','admin')->first();

    	if(!$user){
    		return Response::json(array('fail' => 1, 'message' => 'User Not Exist'));
    		exit;

    	}

    	$user->is_rm    =  'yes';
    	if(!$user->save()){
    		return Response::json(array('fail' => 1, 'message' => 'Cant saved'));
    		exit;
    	}

    	return Response::json(array('success' => 1, 'message' => 'Successfull'));
    }

    public function removeRmAjax(Request $request){
    	if(!$request->ajax()){
    		return Response::json(array('fail' => 1,'message'=>'unauthorised'));
    		exit;
    	}

    	if(!$request->has('userid')){
    		return Response::json(array('fail' => 1, 'message' => 'unauthorised'));
    		exit;
    	}

    	$user 				=	User::where('id', $request->userid)->where('user_type','admin')->first();

    	if(!$user){
    		return Response::json(array('fail' => 1, 'message' => 'User Not Exist'));
    		exit;

    	}

    	$user->is_rm    =  'no';
    	if(!$user->save()){
    		return Response::json(array('fail' => 1, 'message' => 'Cant saved'));
    		exit;
    	}

    	return Response::json(array('success' => 1, 'message' => 'Successfull'));
    }

    public function assignRmAjax(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!$request->has('subscriptionid') || !$request->has('userid')){
            echo 'bad parameters';
            exit;
        }

        $subscription         =   Subscription::where('id',$request->subscriptionid)->first();

        if(!$subscription){
            echo 'Subscriptin does not exist';
            exit;
        }

        if(!User::where('id',$request->userid)->where('user_type', 'admin')->where('is_rm','yes')->first()){
            echo 'invalid user';
        }

        $subscription->rm     =     $request->userid;

        if(!$subscription->save()){
            echo 'cant saved';
        }

        return Response::json(array('success' =>true, 'message' => 'successfully saved'));
    }
}
