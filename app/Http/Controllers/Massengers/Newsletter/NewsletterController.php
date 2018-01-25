<?php

namespace App\Http\Controllers\Massengers\Newsletter;
use App\Http\Requests\Newsletter\NewsletterRequest;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Newsletter, Response, Mail;

class NewsletterController extends Controller{
    
    public function saveNewsletter(NewsletterRequest $request){

    	if(!$request->ajax()){
    		exit;
    	}

    	$newsletter = new Newsletter;
    	$newsletter->email = $request->email;

    	if(!$newsletter->save()){
    		return Response::json(['message' => 'Unknown error occured'],421);
    	}
        
        Mail::send('emails.newsletter', ['newsletter' => $newsletter], function ($m) use ($newsletter) {
            $m->from('payments@techturtle.in', 'Techturtle');
            $m->to($newsletter->email,'User Name')->subject('Successfully Suscribed for Newsletter');
        });
    	return Response::json(['message' => 'You have suscribed successfully'],202);
    }
}
