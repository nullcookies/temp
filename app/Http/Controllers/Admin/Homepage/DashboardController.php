<?php

namespace App\Http\Controllers\Admin\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use View;
use App\Models\Pages\NotificationModel;
use App\Models\Orders\Orders;
use App\Models\Sessions\Sessions as SavedSessions;
use App\Models\UniqueVisitors\UniqueVisitors;
use App\Models\Orders\OrderProducts, Carbon\Carbon, DB;
use App\Models\Product\Product, App\Models\Trial\Trial;
use App\Models\Checklist\CheckList,Response;

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class DashboardController extends Controller{
    
    public $data;
    public function __construct(){
        $this->data     =   array();
    }
    
    public function getLastNDays($days, $format = 'd'){
        $m = date("m"); $de= date("d"); $y= date("Y");
        $dateArray = array();
        for($i=0; $i<=$days-1; $i++){
            $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
        }
        return array_reverse($dateArray);
    }

    public function index(){
        $this->data['project_name']     =   PROJECT_NAME;
        $this->data['notifications']    =   NotificationModel::orderBy('created_at','desc')->limit(10)->get();
        $this->data['total_count']      =   Orders::count();
        $this->data['return_count']     =   DB::table('return_request')->wheremonth('recordInsertedDate','=', date('m'))->count();
        $this->data['totalRevenue']     =   Orders::where('status','completed')->sum('orderAmount') ? Orders::where('status','completed')->sum('orderAmount') : 0 ;
        $this->data['datewiseUsersStats'] = UniqueVisitors::whereMonth('date','=', date('m'))->whereYear('date','=',date('Y'))->get();
        $this->data['dateArr']            = array();
        $this->data['userCountArr']       = array();
        $this->data['todayTotalOrders']   = Orders::whereDay('created_at','=',date('d'))->whereMonth('created_at','=', date('m'))->whereYear('created_at','=',date('Y'))->count();
        $yesterday = Carbon::yesterday();
        $this->data['yesterdayTotalOrders']   = Orders::whereDay('created_at','=',$yesterday->day)->whereMonth('created_at','=', $yesterday->month)->whereYear('created_at','=',$yesterday->year)->count();
        $this->data['diffFromTodayAndYesterday']        = ($this->data['todayTotalOrders'] - $this->data['yesterdayTotalOrders']);
        $this->data['orderDiffSign']      = $this->data['diffFromTodayAndYesterday'] > 0 ? '+' : '-';
        $this->data['criticalOrders']                   = Orders::whereDate('created_at','<', Carbon::today())->where('status','open')->count();
        $this->data['criticalOrdersValue']                   = Orders::whereDate('created_at','<', Carbon::today())->where('status','open')->sum('orderAmount');
        
        $thisMonthReturns                 = DB::table('return_request')->whereMonth('recordInsertedDate', '=', date('m'))->whereYear('recordInsertedDate', '=', date('Y'))->count();
        $previousMonthReturns                 = DB::table('return_request')->whereMonth('recordInsertedDate', '=', date('m') - 1)->whereYear('recordInsertedDate', '=', date('Y'))->count();
        
        //dd($thisMonthReturns,$previousMonthReturns);
        $this->data['returnDiff'] = $thisMonthReturns - $previousMonthReturns;
        $this->data['returnDiffsign']  = $this->data['returnDiff'] > 0 ? '+' : '-';
        $date                       = '';
        $visitors                   = '';
        $datewiseVisitors           = array();
        foreach($this->data['datewiseUsersStats'] as $userCount){
            $this->data['userCountArr'][date("d", strtotime($userCount->date))] = intval($userCount->count);
            $date                   .= intval(date("d", strtotime($userCount->date))).',';
            $visitors               .= intval($userCount->count).',';
            $datewiseVisitors[]       = intval(date("d", strtotime($userCount->date))).','.intval($userCount->count);
        }

        $this->data['date']               = $date;
        $this->data['visitors']           = $visitors;
        $this->data['datewiseVisitors']   = $datewiseVisitors;

        $this->data['dashboardOrders']    = Orders::orderBy('created_at','desc')->limit(5)->get();

        foreach($this->data['dashboardOrders'] as $dashboardOrder){
            $this->data['product_link'][$dashboardOrder->id]   = ($dashboardOrder->order_type == 'api') ? 'http://digishoppers.com/productdetail/'.$dashboardOrder->productId : 'javascript:;';
            $class = 'tag-primary';

            if($dashboardOrder->status == 'cancel'){
                $class = 'tag-danger';
            }

            if(in_array($dashboardOrder->status,['Completed','completed'])){
                $class = 'tag-success';
            }

            if($dashboardOrder->status == 'return'){
                $class = 'tag-warning';
            }
            $classes[] = $class;
            $this->data['class'][$dashboardOrder->id]          =  $class;
            $this->data['products'][$dashboardOrder->id]       =  OrderProducts::where('order_id', $dashboardOrder->id)->get();
        }
        
        $graphNormalOrders = OrderProducts::join('orders','orders.id','=','order_products.order_id')->whereDate('orders.created_at','>',Carbon::now()->addDays(-7))->where('order_products.product_type','normal')->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('count(orders.id) as count'), 'order_products.product_type')
                  ->groupBy('date')
                  ->get();

        $graphApiOrders = OrderProducts::join('orders','orders.id','=','order_products.order_id')->whereDate('orders.created_at','>',Carbon::now()->addDays(-7))->where('order_products.product_type','api')->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('count(orders.id) as count'), 'order_products.product_type')
                  ->groupBy(['date'])
                  ->get();

        $graphAllOrders = OrderProducts::join('orders','orders.id','=','order_products.order_id')->whereDate('orders.created_at','>',Carbon::now()->addDays(-7))->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('count(orders.id) as count'), 'order_products.product_type')
                  ->groupBy(['date'])
                  ->get();

        // new code from here
        $allOrderDateArr  = array();
        $allOrderCountArr = array();
        foreach($graphAllOrders as $userCount){
            $date     = Carbon::parse($userCount->date)->format('d');
            $allOrderDateArr[] = $date;
            $allOrderCountArr[$date] = $userCount->count;
        }

        $normalOrderDateArr  = array();
        $normalOrderCountArr = array();
        foreach($graphNormalOrders as $userCount){
            $date     = Carbon::parse($userCount->date)->format('d');
            $normalOrderDateArr[] = $date;
            $normalOrderCountArr[$date] = $userCount->count;
        }

        $apiOrderDateArr  = array();
        $apiOrderCountArr = array();
        foreach($graphApiOrders as $userCount){
            $date     = Carbon::parse($userCount->date)->format('d');
            $apiOrderDateArr[] = $date;
            $apiOrderCountArr[$date] = $userCount->count;
        }

        $apiOrderGraphData          =   array();
        $normalOrderGraphData       =   array();
        $allOrderGraphData          =   array();

        $sevenDayAgo = Carbon::now()->addDays(-7)->format('d');
        $todayWhat   = Carbon::today()->format('d');
        $dateArr     = array();

        foreach(self::getLastNDays(8) as $i){
            $dateArr[] = $i;
            $allOrderCount = 0;
            $normalOrderCount = 0;
            $apiOrderCount = 0;
            
            if(in_array($i,$allOrderDateArr)){
                $allOrderCount = $allOrderCountArr[$i];
            }

            if(in_array($i,$normalOrderDateArr)){
                $normalOrderCount = $normalOrderCountArr[$i];
            }

            if(in_array($i,$apiOrderDateArr)){
                $apiOrderCount = $apiOrderCountArr[$i];
            }

            $allOrderGraphData[] = $allOrderCount;
            $normalOrderGraphData[] = $normalOrderCount;
            $apiOrderGraphData[] = $apiOrderCount;
            
        }
        

        $this->data['graphDates'] = implode(',', $dateArr);
        $this->data['allOrderGraphData'] = implode(',', $allOrderGraphData);
        $this->data['normalOrderGraphData'] = implode(',', $normalOrderGraphData);
        $this->data['apiOrderGraphData'] = implode(',', $apiOrderGraphData);
        
        /* inventory section */
        $inventory = DB::select("select (select count(DISTINCT product.id) from product join product_category on product_category.product_id = product.id left join product_images on product_images.product_id = product.id where product.quantity > 0 and product_images.default_image = 'yes' and product.deleted = 'no') as instock,count(DISTINCT product.id) as count from product join product_category on product_category.product_id = product.id left join product_images on product_images.product_id = product.id where product.deleted = 'no' and product_images.default_image = 'yes'");
        $this->data['inventory'] = $inventory[0];
        
        /* trails duration */
        
        $this->data['trial'] =   $trial  = Trial::orderBy('created_at','desc')->first();
        $this->data['remaining_days']    =  array();
        if($trial){
            $created = Carbon::now();
            $this->data['daysRemain'] = $difference = ($created->diff($trial->created_at)->days);
            $trialLimit = 7;
            $this->data['trialDiff'] = $trialDifference = ($trialLimit - $difference);
            $this->data['perc']      = $trialDifference > 0 ? intval(($difference/$trialLimit) * 100 ) : 100;
            $this->data['text']      = $trialDifference > 0 ? $trialDifference.' days remaining': 'trial expired';
        }
        //dd($this->data);
        
        $this->data['checklist'] = CheckList::first();
        
        return View::make('admin.homepage.dashboard', $this->data);
    }
    
    public function getTrial(){
        $this->data['trial'] =   $trial  = Trial::orderBy('created_at','desc')->first();
        $this->data['remaining_days']    =  array();
        if($trial){
            $created = Carbon::now();
            $this->data['daysRemain'] = $difference = ($created->diff($trial->created_at)->days);
            $trialLimit = 7;
            $this->data['trialDiff'] = $trialDifference = ($trialLimit - $difference);
            $this->data['perc']      = $trialDifference > 0 ? intval(($difference/$trialLimit) * 100 ) : 100;
            $this->data['text']      = $trialDifference > 0 ? $trialDifference.' days remaining': 'trial expired';
        }
        return $this->data;
    }
}
