<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session, DB;
use App\User;
use App\Helper\SmsHelper;
use App\Models\Trial\Trial;

class TrialSuccessSms{

    public function handle($request, Closure $next, $guard = null){
        
        $trial   = Trial::join('users','users.id','=','trials.user_id')->select('trials.id','trials.sms_sent','users.name','users.mobile')->where('trials.sms_sent','no')->first();
        
        $sms    = new SmsHelper;
        if($trial){
            $mobile_number = $trial->mobile;
			$sender_name   = 'TECHTL';
			$rmName        = 'Ankit';
			$rmMobile      = '7290018827';
			$name          = substr($trial->name,0,12);
			$message       = "Hi ".$name." Your Ecommerce Trial has successfully been started. If Have Have Any Query You Can Contact your Relationship Manager ".$rmName." on ".$rmMobile.".";
    		$send_otp      = json_decode($sms->sendSms($mobile_number, $message, $sender_name));

    		if(isset($send_otp->status) || $send_otp->status == 'success'){
    			$trial->sms_sent = 'yes';
    		}
    		$trial->save();
        }
        
       
        return $next($request);
    }
}
