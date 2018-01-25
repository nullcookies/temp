<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\CouponCreateRequest;
use App\Http\Requests\Coupon\DeleteCouponRequest;
use App\Http\Requests\Coupon\UpdateCouponPageRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use View, Auth, Session, Carbon\Carbon;
use App\User, DB, Redirect, Input, Response;

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class CouponController extends Controller{
    
    public $data;

    public function __construct(){
        $this->data             =   array();
    }

    public function index(Request $request){

        $data                   =   $this->data;
        $recoardPerpage         =   10;
        $coupons                =   DB::table('coupons');

        if($request->q && strlen($request->q)>0){
            $searchVar          =   $request->q;
            $coupons            =   $coupons->where(function($query) use ($searchVar){
                $query->where('coupon_name','like','%'.$searchVar.'%');
                $query->orWhere('coupon_code','like','%'.$searchVar.'%');
            });
        }

        if($request->start_date && strlen($request->start_date)>0 && strtotime($request->start_date) ){
           $coupons             =   $coupons->where('date_start','<',$request->start_date);
        }

        if($request->end_date && strlen($request->end_date)>0 && strtotime($request->end_date) ){
           $coupons             =   $coupons->where('date_end','>',$request->end_date);
        }

        if($request->status && strlen($request->status) && in_array($request->status, ['enabled','disabled'])){
           $coupons             =   $coupons->where('status',$request->status);
        }

        $data['searchq']        =   ($request->q && strlen($request->q)>0) ? $request->q : '';
        $data['start_date']     =   ($request->start_date && strlen($request->start_date)>0 && strtotime($request->start_date)) ? $request->start_date : '';
        $data['end_date']       =   ($request->end_date && strlen($request->end_date)>0 && strtotime($request->end_date)) ? $request->end_date : '';
        $data['status']         =   ($request->status) ? $request->status : 'all';

        $data['coupons']        =   $coupons->where('deleted','no')->paginate($recoardPerpage);
        $data['current_page']   = $data['coupons']->currentPage();
        $data['index_items']    = ($recoardPerpage*$data['current_page'])-($recoardPerpage-1);
        return view('admin/coupon/coupon',$data);
    }

    public function create(){
        return view('admin/coupon/create_coupon');
    }

    public function save(CouponCreateRequest $request){
        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }

        $saveCoupon             =   DB::table('coupons')->insertGetId(array(
            'coupon_name'               =>  $coupon_name,
            'coupon_code'               =>  $coupon_code,
            'coupon_type'               =>  $coupon_type,
            'discount'                  =>  $discount,
            'minimum_order_amt'         =>  $minimum_order_amt,
            'minimum_order_amt_type'    =>  $minimum_order_amt_type,
            'free_shipping'             =>  $free_shipping,
            'date_start'                =>  $start_date,
            'date_end'                  =>  $end_date,
            'per_coupon_limit'          =>  $per_coupon_limit,
            'per_user_limit'            =>  $per_user_limit,
            'description'               =>  $description,
            'status'                    =>  $status,
        ));

        if(!$saveCoupon){
            Session::flash('error_msg','Data Cant saved');
            return Redirect::back();
        }

        Session::flash('success','Coupon Successfully Saved');
        Session::flash('coupon_id',$saveCoupon);
        return redirect(ADMIN_URL_PATH.'/coupon/');
    }

    public function delete(DeleteCouponRequest $request){
        
        $coupon_id                      =   $request->delete_coupon_id;
        $coupon                         =   DB::table('coupons')->where('id',$coupon_id)->update(array(
            'deleted'                          =>  'yes',
        ));

        if(!$coupon){
            Session::flash('error_msg','Data Cant Deleted');
            return Redirect::back();
        }

        Session::flash('success','Coupon Successfully Successfully Deleted');
        return Redirect::back();
    }

    public function change_status(Request $request){
        if(!$request->ajax()){
            die('invalid request');
        }

        $updateStatus                   =   DB::table('coupons')->where('id',$request->coupon_id)->update(array(
            'status'                    =>  $request->status,
        ));

        $response                       =   Response::json(array('status' => 1));

        if(!$udateStatus){
            $response                   =   Response::json(array('status' => 0));
        }

        return $response;
    }

    public function update_coupon(UpdateCouponPageRequest $request){

        $data                           =   $this->data;

        $data['coupon']                 =   DB::table('coupons')->where('id',$request->c)->first();

        if(!$data['coupon']){
            return redirect(ADMIN_URL_PATH.'/coupon');
        }

        $data['coupon_id']              =   $request->c;
        return view('admin/coupon/update_coupon', $data);
    }

    public function save_updated_data(UpdateCouponRequest $request){
        $data                           =   $this->data;

        $coupon                         =   DB::table('coupons')->where('id',$request->coupon_id);

        $data['coupon']                 =   $coupon->first();
        if(!$data['coupon']){
            return redirect(ADMIN_URL_PATH.'/coupon');
        }

        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }

        $update                         =   $coupon->update(array(
            'coupon_name'               =>  $coupon_name,
            'coupon_code'               =>  $coupon_code,
            'coupon_type'               =>  $coupon_type,
            'discount'                  =>  $discount,
            'minimum_order_amt'         =>  $minimum_order_amt,
            'minimum_order_amt_type'    =>  $minimum_order_amt_type,
            'free_shipping'             =>  $free_shipping,
            'date_start'                =>  $start_date,
            'date_end'                  =>  $end_date,
            'per_coupon_limit'          =>  $per_coupon_limit,
            'per_user_limit'            =>  $per_user_limit,
            'description'               =>  $description,
            'status'                    =>  $status,
        ));

        $response                       =   redirect(ADMIN_URL_PATH.'/coupon');

        if(!$update){
            $response                   =   Redirect::back();
        }

        return $response;
    }
}
