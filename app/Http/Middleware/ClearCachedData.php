<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session, DB;
use App\User;
use App\Models\CachedData\CachedData;
use App\Models\Checkout\BuyNow;
use App\Models\Checkout\BuyNowProducts;
use App\Models\Orders\Orders;
use App\Models\Orders\OrderProducts;
use App\Models\UniqueVisitors\UniqueVisitors;

class ClearCachedData{

    public function handle($request, Closure $next, $guard = null){
        $cachedData = CachedData::first();

        if(!$cachedData){
            return $next($request);
            exit;
        }

        if($cachedData->cleared_everything == 'yes'){
            return $next($request);
            exit;
        }

        if(!$cachedData->user_id || !$cachedData->trial_id){
            return $next($request);
            exit;
        }

        if($cachedData->cleared_users == 'no'){
            $clearUser = User::whereNotIn('id', [$cachedData->user_id])->delete();
            
            if($clearUser){
                $cachedData->cleared_users = 'yes';
                $cachedData->save();
            }
        }

        if($cachedData->cleared_tial == 'no'){
            $clearTrial  = DB::table('trials')->whereNotIn('id', [$cachedData->trial_id])->delete();

            if($clearTrial){
                $cachedData->cleared_tial = 'yes';
                $cachedData->save();
            }
        }

        if($cachedData->cleared_buy_now == 'no'){
            $clear_buy_now = BuyNow::truncate();
            if($clear_buy_now){
                $cachedData->cleared_buy_now = 'yes';
                $cachedData->save();
            }
        }

        if($cachedData->cleared_buy_now_products == 'no'){
            $clear_buy_now_products = BuyNowProducts::truncate();

            if($clear_buy_now_products){
                $cachedData->cleared_buy_now_products = 'yes';
                $cachedData->save();
            }
        }

        if($cachedData->cleared_order == 'no'){
            $clear_order    = Orders::truncate();

            if($clear_order){
                $cachedData->cleared_order = 'yes';
                $cachedData->save();
            }
        }
        
        if($cachedData->cleared_order_products == 'no'){
            $clear_order_product    = OrderProducts::truncate();

            if($clear_order_product){
                $cachedData->cleared_order_products = 'yes';
                $cachedData->save();
            }
        }
        
        if($cachedData->cleared_visitor_count == 'no'){
            $clear_visitor_count = UniqueVisitors::truncate();
            
            if($clear_visitor_count){
                $cachedData->cleared_visitor_count = 'yes';
                $cachedData->save();
            }
        }
        
        if($cachedData->cleared_session_data == 'no'){
            DB::table('kryptonit3_counter_page')->truncate();
            DB::table('kryptonit3_counter_page_visitor')->truncate();
            DB::table('kryptonit3_counter_visitor')->truncate();

            $cachedData->cleared_session_data = 'yes';
            $cachedData->save();
        }

        if($cachedData->cleared_users == 'yes' && $cachedData->cleared_tial == 'yes' && $cachedData->cleared_buy_now == 'yes' && $cachedData->cleared_buy_now_products == 'yes' && $cachedData->cleared_order == 'yes' && $cachedData->cleared_order_products == 'yes' && $cachedData->cleared_visitor_count == 'yes' && $cachedData->cleared_session_data == 'yes' ){
            $cachedData->cleared_everything = 'yes';
            $cachedData->save();
        }

        return $next($request);
    }
}
