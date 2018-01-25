<?php

namespace App\Http\Controllers\Admin\WebsiteAnalytics;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Counter, Activity;
use App\Models\Sessions\Sessions as SavedSessions;
use App\Models\UniqueVisitors\UniqueVisitors;

class WebsiteAnalyticsController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data = array();
    }

    public function showWebsiteAnalysis(Request $request){
    	
    	$data 					 	=	$this->data;
    	$data['recently_active'] 	= Activity::usersBySeconds(30)->count()+Activity::guestsBySeconds(30)->count();
    	$data['today_sessions']	 	= SavedSessions::whereDate('created_at','=',date('Y-m-d'))->count();
    	$data['datewiseUsersStats'] = UniqueVisitors::whereMonth('date','=', date('m'))->whereYear('date','=',date('Y'))->get();
    	$data['dateArr']            = array();
    	$data['userCountArr']		= array();
    	
    	$date                       = '';
    	$visitors                   = '';
		foreach($data['datewiseUsersStats'] as $userCount){
			$data['userCountArr'][date("d", strtotime($userCount->date))] = intval($userCount->count);
			$date 					.= intval(date("d", strtotime($userCount->date))).',';
			$visitors 				.= intval($userCount->count).',';
		}

		$data['date']               = $date;
		$data['visitors'] 			= $visitors;

       	return view('admin/website_analytics/website_analytics',$data);
    }

}
