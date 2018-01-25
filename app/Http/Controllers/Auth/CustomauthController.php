<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, URL;
use App\Http\Requests\Auth\AjaxLoginRequest;
use App\Http\Requests\Auth\AjaxRegisterRequest;
use App\User, Mail, Redirect;
use App\Http\Requests\LoginOtp\LoginOtpRequest;
use App\Helper\SmsHelper, Session, Response;
use App\Http\Requests\LoginOtp\VerifyOtpRequest;

class CustomauthController extends Controller{
    
    protected $sms;
    public function __construct(){
        $this->sms      =   new SmsHelper;
    }

    public function postLogin(AjaxLoginRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}

    	if(Auth::user()){
    		exit;
    	}

	    $auth = false;
	    $responseCode = 421;
	    $message = "Invalid Credientials";
	    $credentials = $request->only('email', 'password');

	    if (Auth::attempt($credentials)) {
	        $auth = true; // Success
	        $responseCode = 200;
	        $message = "successfully logged in";
	    }

	    if ($request->ajax()) {
	        return response()->json([
	        	'message' => $message,
	            'auth' => $auth,
	            'intended' => URL::previous(),
	        ],$responseCode);
	    } else {
	        return redirect()->intended(URL::route('dashboard'));
	    }
	    return redirect(URL::route('login_page'));
	}

	public function postRegister(AjaxRegisterRequest $request){
		if(!$request->ajax()){
    		exit;
    	}

    	if(Auth::user()){
    		exit;
    	}

		if($user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'authority'     => 1,
        ])){
            
            Mail::send('emails.register', ['user' => $user], function ($m) use ($user) {
                $m->from('payments@techturtle.in', 'Techturtle');
                $m->to($user->email,$user->name)->subject('Registered Successfully');
            });
            
			return response()->json([
	        	'message' => 'Successfully Registerd',
	            'intended' => URL::previous(),
	        ],202);
        }else{
        	return response()->json([
	        	'message' => 'Some error Occured, Try again',
	            'intended' => URL::previous(),
	        ],202);
        }
	}
	
	
	public function customregister(AjaxRegisterRequest $request){
	    if(Auth::user()){
    		dd('already authenticated');
    	}
    	
    	if($user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'authority'     => 1,
        ])){
            
            Mail::send('emails.register', ['user' => $user], function ($m) use ($user) {
                $m->from('payments@techturtle.in', 'Techturtle');
                $m->to($user->email,$user->name)->subject('Registered Successfully');
            });
            
            Auth::login($user);
			return redirect()->intended('/');
        }else{
        	dd('some error');
        }
	}
	
	public function loginwithoutpassword(Request $request){
	    
	    if(Auth::user()){
	        return Redirect::back();
	    }
	    
	    return view('loginwithoutpass/loginwithoutpass');
	}
	
	public function sendotp(Request $request){

	    $record = User::where('email',$request->email)->orWhere('mobile',$request->email)->first();
	    if(!$record){
	        
	        if($request->ajax()){
	            return Response::json(['message' => 'Please enter your registerd email or mobile'],421);
	        } else{
	            return Redirect::back()->with('status','Please enter your registerd email or mobile');
	        }
	        
	    }
	    
	    $otp = rand(1000,9999);
	    
	    $record->otp_code = $otp;
	    
	    if(!$record->save()){
	        if($request->ajax()){
                return Response::json(['status' => 0 , 'message' => 'Try Again'],421);
            } else{
                return Redirect::back()->with('status','Try Again');
            }
	    }
	    
        Mail::send('emails.otp', ['user' => $record, 'otp' => $record->otp_code], function ($m) use ($record) {
            $m->from('payments@techturtle.in', 'Massengers');
            $m->to($record->email,$record->name)->subject('Login OTP');
        });
        
        
        if(strlen($record->mobile)){
            $mobile_number = $record->mobile; 
    		$sender_name   = 'MSNGRS';
    		$message       = "$otp is your confidential OTP for Massengers account. Valid for 10 mins only, this OTP will let you in. Happy shopping!
Massengers";
    		$send_otp      = json_decode($this->sms->sendSms($mobile_number, $message, $sender_name));
        }

        if($request->ajax()){
            return Response::json(['status' => 1 , 'message' => 'Otp Sent Successfully'],202);
        } else{
            Session::set('otpverify', true);
            Session::set('otpemail', $record->email);
            Session::set('otpmobile', $record->mobile);
            return Redirect::to('/confirm-otp');
        }
        
	}
	
	
	public function confirmotp(Request $request){
	    
	    if(Auth::user()){
	       return redirect('/') ;
	    }
	    
	    if(!Session::has('otpverify')){
	        return Redirect::back();
	    }
	    
	    return view('loginwithoutpass/confirmotp');
	}
	
	public function verifyotp(VerifyOtpRequest $request){
	    
	    if(!$request->ajax()){
	        exit;
	    }
	    
	    $record = User::where('email', $request->email)->first();
	    
	    if(!$record){
	        return Response::json(['message' => 'Refresh the page and Try Again', 'status' => 0 ],421);
	    }
	    
	    if($record->otp_code != $request->otp){
	        return Response::json(['message' => 'incorrect otp', 'status' => 0],421);exit;
	    }
	    
	    Auth::loginUsingId($record->id, true);
	    
	    return Response::json(['status' => 1 , 'message' => 'Otp verified Successfully'],202);
	}
}
