<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\SaveNotificationRequest;
use App\Models\Pages\NotificationModel, Response, Auth, Session, Redirect;

class PagesController extends Controller{
    
    public function __construct(){}

    public function showNotificationAdminPage(Request $request){
    	return view('admin/pages/post_notification');
    }

    public function saveNotification(SaveNotificationRequest $request){
    	
    	foreach($request->all() as $key => $value){
    		$$key 		=	$value;
    	}

    	if(!in_array($type,['notification','notice'])){
    		return Redirect::back();
    	}

    	$notification 				=	new NotificationModel;
    	$notification->title 		=	$title;
    	$notification->type 		=	$type;
    	$notification->inserted_by 	=	Auth::user()->id;
    	$notification->content 		=	$product_desc;

    	$message 					=	"Notification successfully saved";
    	$class 						=	"success";
    	
    	if(!$notification->save()){
    		$message 					=	"Notification Could not saved";
    		$class 						=	"danger";
    	}

    	Session::flash('message', $message);
    	Session::flash('class', $class);
    	return Redirect::back();
    }
}
