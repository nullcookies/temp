<?php

namespace App\Http\Controllers\Front\Order;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Orders\Orders;
use App\User, Auth;
use App\Models\Api\ApiProduct;
use App\Models\ProductImage\ProductImage, File, Carbon\Carbon;

class MyOrderController extends Controller{
    
    public $data;
	public function __construct(){
        $this->data         =   array();
	}

    public function myorders(Request $request){
        $this->data['orders'] = User::find(Auth::user()->id)->orders()->paginate(5);

        $apiProductArr         =   array();
        $productArr         =   array();
        foreach($this->data['orders'] as $order){
            
            foreach($order->products as $product){
                $this->data['productImage'][$product->id] = $product->product_image != '' ? $product->product_image :url('no_image.png');
            }

            $status_box_class = '';
            $orderstatus = $order->status;

            if($orderstatus == ''){
                $orderstatus = 'In progress';
            }

            if($orderstatus == 'open'){
                $orderstatus = 'Order Placed';
            }

            if($order->status == 'open' || $order->status == 'delivered'){
                $status_box_class = 'status-box';
            }

            if($order->status == 'cancel'){
                $orderstatus    = 'canceled';
            }

            $estimatedeliverybegun  = Carbon::parse($order->created_at)->addDay(10)->format('D d-M-Y');
            $estimatedeliveryends   = Carbon::parse($order->created_at)->addDay(15)->format('D d-M-Y');
            
            $this->data['estimate_delivery_date'][$order->id] = $estimatedeliverybegun.'-'.$estimatedeliveryends;
            $this->data['status_box_class'][$order->id] = $status_box_class;

            $this->data['orderstatus'][$order->id] = $orderstatus;
        }

    	return view('front/order/myorders',$this->data);
    }

    public function orderdetails(Request $request){
    	return view('front/order/orderdetails');
    }

    public function cancleorder(Request $request, $orderid){
        $data = array();
        $data['orderid'] = $orderid;
    	return view('front/order/cancleorder', $data);
    }

    public function returnOrder(Request $request, $orderid){

        $data = array();
        $data['orderid'] = $orderid;
        return view('front/order/returnorder', $data);
    }
}
