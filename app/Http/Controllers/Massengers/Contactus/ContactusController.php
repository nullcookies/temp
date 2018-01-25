<?php

namespace App\Http\Controllers\Massengers\Contactus;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ContactUs;
use App\Http\Requests\ContactUsRequest;
use Redirect;


class ContactusController extends Controller{
    
    public function __construct(){
    }

    public function contactus(Request $request){
    	return view('massengers/contactus/contactus');
    }
    
    public function saveData(ContactUsRequest $request){
        $contactus = new ContactUs;
        
        $contactus->name= $request->name;
        $contactus->email= $request->email;
        $contactus->mobile= $request->mobile;
        $contactus->message= $request->message;
        
        if(!$contactus->save()){
            return Redirect::back()->with('error','Try again');
        }
        
        return Redirect::back()->with('success','Your query successfully submitted');
    }
}
