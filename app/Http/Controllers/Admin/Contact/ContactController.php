<?php

namespace App\Http\Controllers\Admin\Contact;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect, Session, Mail, Validator, Response;
class ContactController extends Controller
{

	public $data;
	public function __construct(){
		$this->data 	=	[];
	}

    public function index()
    {
    	return view('admin/contact/index');
    }
    public function mailme()
    {
    	return view('admin/contact/mailme');
    }
    public function messagCenter()
    {
    	return view('admin/contact/messagecenter');
    }
    public function postcontact(Request $request){

    	$this->validate($request, [
    			'email' => 'required|email',
    			'subject' => 'required',
    			'message_body' => 'required|min:15'
    		]);
    	$data = [
    		'email' => $request->email,
    		'subject' => $request->subject,
    		'message_body' => $request->message_body,
    	];
    	Mail::send('admin.emails.mailme', $data, function($message) use ($data){			
			$message->to($data['email']);
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your Email was Sent!');
		return redirect('admin/message/mail-me');
    }


}
