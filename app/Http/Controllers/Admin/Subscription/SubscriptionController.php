<?php

namespace App\Http\Controllers\Admin\Subscription;

use Illuminate\Http\Request;
use App\Http\Requests, Response;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Subscription;
use App\Models\UserLocation\Country;
use App\Models\UserLocation\State;
use App\Models\UserLocation\City;
use App\Models\Subscription\Themes;
use App\Models\Subscription\Plans;
use App\Models\Subscription\TimeSlot;
use App\Models\Subscription\SubscriptionPrice;
use App\Http\Requests\Admin\Subscription\SaveSubscriptionRequest;
use Carbon\Carbon, Session;
use App\User;

class SubscriptionController extends Controller{
   	
   	public $data;
   	public function __construct(){
   		$this->data = array();
   	}

   	public function showList(Request $request){

   		$this->data['subscriptions'] = new Subscription;

   		if(isset($request->email) && strlen($request->email)>0){
   			$this->data['subscriptions'] = $this->data['subscriptions']->where('email','=',$request->email);
   		}

   		$this->data['subscriptions'] = $this->data['subscriptions']->paginate(10);

   		foreach ($this->data['subscriptions'] as $subscription) {
   			$date_diffrence              						          =  date_diff(date_create($subscription->inserted_at),date_create(date('d-m-Y')));
    		$this->data['remaining_days'][$subscription->id] 	=  ($date_diffrence->format("%R%a") < 0)? $date_diffrence->format("%R%a") :$subscription->equal_days-$date_diffrence->format("%a");
    		$this->data['sign'][$subscription->id] 				    =  $date_diffrence->format("%R%");
    		$this->data['text'][$subscription->id] 				    =  ($this->data['remaining_days'][$subscription->id] > 0) ? $this->data['remaining_days'][$subscription->id].' days left in your subscription' : 'your subscription expired before '.$this->data['remaining_days'][$subscription->id].' days';
    		$this->data['perc'][$subscription->id] 				    =  ($this->data['remaining_days'][$subscription->id] > 0) ? ($date_diffrence->format("%a")/($subscription->equal_days))*100 : 100;
        $this->data['current_rm'][$subscription->id]              =  $subscription->rm;  
      }
   		
      $this->data['rms']                                  =   User::where('is_rm','yes')->where('user_type','admin')->select('id','name')->get();
   		return view('admin/subscription/subscriptions', $this->data);
   	}

    public function createNew(Request $request){

      $this->data['countries']  = Country::getIndia();

      $countryArr               = array();
      foreach($this->data['countries'] as $country){
        $countryArr[]           = $country->id;
      }

      $this->data['states']     = State::getStatesByCountry($countryArr);

      $stateArr                 = array();
      foreach($this->data['states'] as $state){
        $stateArr[]             = $state->id;
      }

      $this->data['cities']     = City::getCitiesByStates($stateArr);

      $this->data['themes']     = Themes::getThemes();

      $this->data['plans']      = Plans::getAllPlans();

      $this->data['timeslots']  = TimeSlot::getAllSlots();
      return view('admin/subscription/createSubscriber', $this->data);
    }

    public function getCityAjax(Request $request){

      if(!$request->ajax()){
        echo 'bad request';
        exit;
      }

      if(!$request->has('stateid')){
        echo 'invalid parameters';
        exit;
      }

      $cities       = City::getCitiesByStates(array($request->stateid));

      $cityArr      = array();
      foreach($cities as $key => $city){
        $cityArr[$key]  = array('id' => $city->id, 'name' => $city->name);
      }

      return Response::json(array('cities' => $cityArr, 'count' => count($cityArr)));
    }

    public function getPriceAjax(Request $request){
      if(!$request->ajax()){
        echo 'bad request';
        exit;
      }

      if(!$request->has('themeid') || !$request->has('planid') || !$request->has('timeslotid') ){
        echo 'invalid parameters';
        exit;
      }

      $price    = SubscriptionPrice::getPrice($request->themeid,$request->planid,$request->timeslotid);

      $price    = $price ? round($price->payamount) : 'NO entry on database';

      return response::json(array('success'=> true, 'price' =>$price));
    }

    public function saveSubscription(SaveSubscriptionRequest $request){
      
      foreach($request->all() as $key => $value){
        $$key     = $value;
      }

      $price    = SubscriptionPrice::getPrice($theme,$plan,$time_slot) ? SubscriptionPrice::getPrice($theme,$plan,$time_slot)->payamount : 0;

      $subscription = new Subscription;

      $subscription->net_amount_debit         = $price;
      $subscription->payment_completed_at     = Carbon::now();
      $subscription->productinfo              = Themes::getThemeById($theme)->product_name;
      $subscription->planid                   = $plan;
      $subscription->slotid                   = $time_slot;
      $subscription->equal_days               = TimeSlot::getSlotById($time_slot)->equalday;
      $subscription->firstname                = $name;
      $subscription->address                  = $street_address;
      $subscription->city                     = City::getCityById($city)->name;
      $subscription->state                    = State::getStateById($state)->name;
      $subscription->country                  = Country::getCountryById($country)[0]->name;
      $subscription->zipcode                  = $zipcode;
      $subscription->email                    = $email;
      $subscription->phone                    = $phone;
      $subscription->inserted_at              = Carbon::now();

      $message                                = 'Subscription Successfully Saved';
      $class                                  = 'success';
      if(!$subscription->save()){
        $message                              = 'Subscription cant saved';
        $class                                = 'danger';
      }

      Session::flash('class', $class);
      Session::flash('message',$message);
      return redirect(ADMIN_URL_PATH.'/all-subscriptions');

    }

    public function changeSubscriptionStatusAjax(Request $request){

      if(!$request->ajax()){
        echo 'bad request';
        exit;
      }

      if(!$request->has('subscriptionid') || !$request->has('status')){
        echo 'invalid parameters';
        exit;
      }

      $subscription     = Subscription::where('id', $request->subscriptionid)->first();

      if(!$subscription){
        echo 'record not found';
        exit;
      }

      $subscription->active_status  = $request->status;

      if(!$subscription->save()){
        return Response::json(array('fail' => true, 'message' => 'cant saved the record'));
      }

      return Response::json(array('success' => true, 'message' => 'successfully changed the status'));
    }
}
