<?php

namespace App\Http\Controllers\Admin\Subscription;

use Illuminate\Http\Request;

use App\Http\Requests, Auth;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Subscription;

class MySubscriptionController extends Controller{
    
    public $data;

    public function __construct(){
    	$this->data = array();
    }

    public function showMySubscriptions(Request $request){
    	
    	if(!Auth::user()){
    		echo 'Need to login';
    		exit;
    	}

    	$subscription					 =	Subscription::where('email',Auth::user()->email);
    	$this->data['totalSubscription'] =  $subscription->count();
    	$this->data['subscriptions']	 =	$subscription->get();

    	$this->data['remaining_days']	 =	array();
    	foreach ($this->data['subscriptions'] as $subscription) {
    		$date_diffrence              						=  date_diff(date_create($subscription->inserted_at),date_create(date('d-m-Y')));
    		$this->data['remaining_days'][$subscription->id] 	=  ($date_diffrence->format("%R%a") < 0)? $date_diffrence->format("%R%a") :$subscription->equal_days-$date_diffrence->format("%a");
    		$this->data['sign'][$subscription->id] 				=  $date_diffrence->format("%R%");
    		$this->data['text'][$subscription->id] 				=  ($this->data['remaining_days'][$subscription->id] > 0) ? $this->data['remaining_days'][$subscription->id].' days left in your subscription' : 'your subscription expired before '.$this->data['remaining_days'][$subscription->id].' days';
    		$this->data['perc'][$subscription->id] 				=  ($this->data['remaining_days'][$subscription->id] > 0) ? ($date_diffrence->format("%a")/($subscription->equal_days))*100 : 100;
    	}

    	//dd($this->data);
    	return view('admin/subscription/my_subscription', $this->data);
    }

    public function showList(){
        dd('td');
    }
}
