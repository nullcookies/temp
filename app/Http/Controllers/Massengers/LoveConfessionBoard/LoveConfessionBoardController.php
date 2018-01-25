<?php

namespace App\Http\Controllers\Massengers\LoveConfessionBoard;

use Illuminate\Http\Request;
use App\Http\Requests, Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoveConfession\LoveConfessionRequest;
use App\LoveConfession;
use App\Helper\SmsHelper, Auth, DB;
use App\Http\Requests\LoveConfessionReplyRequest;
use App\LoveConfessionReply, Respose, Redirect, App\User; 

class LoveConfessionBoardController extends Controller{
    
    protected $data = [];
    protected $sms;
    public function __construct(){
        $this->sms      =   new SmsHelper;
    }

    public function loveconfessionboard(Request $request){
        $this->data['confessions'] = LoveConfession::join('users','users.id','=','love_confessions.user_id')->select('love_confessions.*')->orderBy('updated_at', 'desc')->paginate(1);
        
        foreach($this->data['confessions'] as $key => $confession){
            $profileimage  = url('/images/profile_image/demo_image.jpg');
            $user = User::find($confession->user_id);
            if($user && strlen($user->profile_image) && File_exists(public_path('/images/profile_image/'.$user->profile_image))){
                $profileimage  = url('/images/profile_image/'.$user->profile_image);
            }
            
            $this->data['profile_image'][$confession->user_id] = $profileimage;
            $this->data['confessionkey'][$confession->id] = $key;
            $this->data['replies'][$confession->id] = LoveConfessionReply::where('lc_id',$confession->id)->orderBy('id','desc')->paginate(20); 
            $this->data['count_likes'][$confession->id] = DB::table('love_confession_likes')->where('confessionid',$confession->id)->count();
            $this->data['count_reply'][$confession->id] = LoveConfessionReply::where('lc_id',$confession->id)->count();
        }
        
    	return view('massengers/loveconfessionboard/loveconfessionboard', $this->data);
    }

    public function saveloveconfession(LoveConfessionRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}
        
        if(!Auth::user()){
            return Response::json(['message' => 'Please login first', 'redirect_url' => url('/login'), 'get_redirect' => 'yes'],202);
        }
        
    	foreach($request->all() as $key => $value){
    		$$key = $value;
    	}

    	$confess_annonymously = 'no';

    	if($request->has('confess_anonymously')){
    		$confess_annonymously = 'yes';
    	}

    	$loveconfession = new LoveConfession;
    	$loveconfession->confessor = $confessor;
    	$loveconfession->message = $message;
    	$loveconfession->confessing_to = $confessing_to;
    	$loveconfession->confess_anonymously = $confess_annonymously;
    	$loveconfession->user_id = Auth::user()->id;
    	
    	if(!$loveconfession->save()){
    		return Response::json(['message' => 'Unknown error occured'],421);
    	}
        
        $mobile_number = $request->mobile_number; 
		$sender_name   = 'MSNGRS';
        $link = "https://goo.gl/UxRPr2";
        $username = substr(Auth::user()->name,0,13);
        $message = "Hi $username! Someone just posted about you on the Love Confession Board of Massengers.com. Click here to check those beautiful words $link";
		//$message       = "Hey name! Someone just posted about you on the Love Confession Board of Massengers.com. Click here to check those beautiful words $link";
		$send_otp      = json_decode($this->sms->sendSms($mobile_number, $message, $sender_name));
    	return Response::json(['message' => 'Your confession saved successfully', 'redirect_url' => '', 'get_redirect' => 'no'],202);
    }
    
    public function givereply(LoveConfessionReplyRequest $request){
        $reply = new LoveConfessionReply;
        $reply->lc_id = $request->lc_id;
        $reply->name  = $request->reply_name;
        $reply->reply  = $request->reply_message;
        $reply->user_id = Auth::user()->id;
        
        if(!$reply->save()){
            return Redirect::back()->with('replyerror','try again');
        }
        
        LoveConfession::where('id',$request->lc_id)->update(['mark_updated' => time()]);
        
        return Redirect::back()->with('replysuccess','Reply successfully');
    }
    
    public function fetchconfessionjscroll(Request $request){
        $this->data['confessions'] = LoveConfession::join('users','users.id','=','love_confessions.user_id')->select('love_confessions.*')->orderBy('updated_at', 'desc')->paginate(1);
        
        foreach($this->data['confessions'] as $key => $confession){
            
            $this->data['confessionkey'][$confession->id] = $key;
            $this->data['replies'][$confession->id] = LoveConfessionReply::where('lc_id',$confession->id)->paginate(10);
            $this->data['count_reply'][$confession->id] = LoveConfessionReply::where('lc_id',$confession->id)->count();
            $this->data['count_likes'][$confession->id] = DB::table('love_confession_likes')->where('confessionid',$confession->id)->count();
        }
        
    	return view('massengers/loveconfessionboard/jscrollconfession', $this->data);
    }
    
    public function fetchconfessionreplyjscroll(Request $request, $confessionid){
        $this->data['replies'] = LoveConfessionReply::where('lc_id',$confessionid)->paginate(1);
        $this->data['confessionid'] = $confessionid;
        return view('massengers/loveconfessionboard/jscrollconfessionreply', $this->data);
    }
    
    public function getlike(Request $request){
        if(!$request->ajax()){
            exit;
        }
        
        if(!$request->has('confessionid')){
            return Response::json(['message' => 'Invalid Request'],421);
        }
        
        if(!Auth::user()){
            return Response::json(['message' => 'Please login to like the confession','redirect_url' => url('/login'), 'get_redirect' => 'yes' ],202);
        }
        
        if(DB::table('love_confession_likes')->where('user_id', Auth::user()->id)->where('confessionid',$request->confessionid)->count()){
            return Response::json(['message' => 'You have already liked this confession'],421);
        }
        
        $getlike = DB::table('love_confession_likes')->insert(['confessionid' => $request->confessionid, 'user_id' => Auth::user()->id]);
        
        if(!$getlike){
            return Response::json(['message' => 'Unexpected Error occured'],421);
        }
        
        LoveConfession::where('id',$request->lc_id)->update(['mark_updated' => time()]);
        
        return Response::json(['message' => 'Successfully liked', 'redirect_url' => '', 'get_redirect' => 'no'],202);
        
    }
}
