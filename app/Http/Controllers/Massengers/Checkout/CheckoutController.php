<?php

namespace App\Http\Controllers\Massengers\Checkout;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Checkout\BuyNow, Redirect;
use App\Models\Checkout\BuyNowProducts;
use App\Models\Address\Address, Auth;
use Carbon\Carbon, Response;
use App\Http\Requests\DeliveryDetails\DeliveryDetailsRequest;
use App\Http\Requests\ValidateCheckout\ProcessToPayRequest;
use App\Http\Requests\ValidateCheckout\BackToDeliveryDetailsRequest;
use Softon\Indipay\Facades\Indipay;  
use App\Models\Orders\Orders, Mail;
use App\Models\Orders\OrderProducts, DB;
use App\Models\Shipping\Pincode;
use App\Models\Shipping\DeliveryWeight;
use App\Models\Shipping\DeliveryCharges;
use App\Http\Controllers\Massengers\Product\ProductController as ProductHelper;

class CheckoutController extends Controller{
    
    protected $data = [];
    public function __construct(){
        $this->middleware('auth');
    }

    public function checkout(Request $request, $buynowid){

        $buynow = BuyNow::find($buynowid);

        if(!$buynow){
            return Redirect::back();exit;
        }

        $this->data['buynow'] = $buynow;
        $this->data['sender_name'] = Auth::user() ? Auth::user()->name : '';
        $this->data['sender_email'] = Auth::user() ? Auth::user()->email : '';

        $this->data['buy_now_products'] = BuyNowProducts::join('buy_now','buy_now.id','=','buy_now_products.buy_now_id')->select('buy_now_products.*','buy_now.shipping_first_name','buy_now.shipping_city','buy_now.shipping_mobile')->where('buy_now_products.buy_now_id', $buynow->id)->get();
    
        $subtotal = 0;
        
        $extra = 0;
        foreach($this->data['buy_now_products'] as $buy_products){
            $this->data['add_more_love_products'][$buy_products->id] = DB::table('add_some_more_love_products')->whereIn('id', explode(',',$buy_products->add_more_love_products_id))->get();
            
            foreach($this->data['add_more_love_products'][$buy_products->id] as $add_more_love_product){
                $extra += $add_more_love_product->price;
            }
        }

        $product_price  		=	0;
		$weight 				=	0;
		$shippingCharge 		=	200;
		$pincode 				=	Pincode::searchPincode($buynow->shipping_pincode);
		$this->data['varientname']   =   [];
		$this->data['varientPrice'] = [];
		foreach($this->data['buy_now_products'] as $product){
		    
		    $this->data['varientname'][$product->id] = DB::table('varient_type_values')->where('id',$product->varients)->select('value')->first();
		    $this->data['varientPrice'][$product->id] = (ProductHelper::getVarientPrice($product->upc,$product->varients, $product->product_selling_price) - $product->product_selling_price) * $product->quantity;
			$product_price +=  ProductHelper::getVarientPrice($product->upc,$product->varients, $product->product_selling_price) * $product->quantity;
			$weight 	   +=  $weight+intval($product->weight);
		}
    
    
		$deliveryWeight  				=	DeliveryWeight::getWeightDomain($weight);

		if($deliveryWeight && $pincode){
    		$shippingPriceData 		=	DeliveryCharges::where('zone_id',$pincode->zone_id )->where('delivery_weight_id', $deliveryWeight['id'])->first();
    		
    		if($shippingPriceData){
    			$shippingCharge     =   $shippingPriceData->price;
    		}
    	}
    	
    	$shippingCharge = $this->data['shipping_charge'] = DB::table('delivery_methods')->where('alias',$buynow->delivery_option)->first() ? DB::table('delivery_methods')->where('alias',$buynow->delivery_option)->first()->shipping_charge : 0;
    	
    	$data['shippingCharge'] = $shippingCharge;
        $totalAmount = $product_price + $extra;

        $this->data['subtotal'] = $totalAmount;
        
        $shipping_time_arr = explode('_', $buynow->shipping_time);

        $this->data['delivery_timing'] = $shipping_time_arr[0].':00-'.$shipping_time_arr[1].':00';

        $this->data['delivering_on']   = Carbon::parse($buynow->selected_delivery_date)->format('D, d-M');

        if(Auth::user()){
            $this->data['addresses'] = Address::where('user_id', Auth::user()->id)->get();
        }
        
        return view('massengers/checkout/checkout', $this->data);
    }

    public function save_delivery_details(DeliveryDetailsRequest $request){
        if(!$request->ajax()){
            exit;
        }

        foreach($request->all() as $key => $value){
            $$key = $value;
        }

        $buynow = BuyNow::find($checkoutid);

        if(!$buynow){
            return Response::json(['message' => 'Please do the checkout again...'],421);
        }

        $buynow->billing_first_name = $sender_name;
        $buynow->billing_email = $sender_email;
        $buynow->billing_mobile = $sender_mobile;
        $buynow->occassion = $occassion;
        $buynow->message_on_card = $message;
        $buynow->shipping_first_name = $shipping_name;
        $buynow->shipping_email = $shipping_email;
        $buynow->shipping_mobile = $shipping_mobile;
        $buynow->shipping_pincode = $shipping_pincode;
        $buynow->shipping_state = $shipping_state;
        $buynow->shipping_city = $shipping_city;
        $buynow->shipping_street_address = $shipping_address_line_1.(strlen($shipping_address_line_2)?',':'').$shipping_address_line_2;
        $buynow->saved_delivery_details = 'yes';
        
        if(!$buynow->save()){
            return Response::json(['message' => 'An Unknown Error occured, try again..'],421);
        }

        return Response::json(['message' => 'success', 'success' => true],202);
    }

    public function go_back_to_delivey_details(BackToDeliveryDetailsRequest $request){

        if(!$request->ajax()){
            exit;
        }

        $buynow = BuyNow::find($request->buynowid);

        if(!$buynow){
            return Response::json(['message' => 'Sorry that order can not proceed'],421);
        }

        if($buynow->accepted_terms == 'no'){
            $buynow->saved_delivery_details = 'no';
        }

        if(!$buynow->save()){
            return Response::json(['message' => 'An Unknown Error occured, try again..'],421);
        }

        return Response::json(['message' => 'success', 'success' => true],202);
    }

    public function proceed_to_pay(ProcessToPayRequest $request){
        if(!$request->ajax()){
            exit;
        }

        $buynow = BuyNow::find($request->checkoutid);

        if(!$buynow){
            return Response::json(['message' => 'Sorry that order can not proceed'],421);
        }

        $buynow->accepted_terms = 'yes';

        if(!$buynow->save()){
            return Response::json(['message' => 'An Unknown Error occured, try again..'],421);
        }

        return Response::json(['message' => 'success', 'success' => true, 'buynowid'=> $buynow->id],202);
    }

    public function delete_checkout_product(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$buynow_product = BuyNowProducts::find($request->itemid)){
            return Response::json(['message' => 'An Unknown Error occured, try again'],421);
        }

        if(BuyNowProducts::where('buy_now_id', $buynow_product->buy_now_id)->count()<2){
            return Response::json(['message' => 'You cant delete the only item of checkout'],421);
        }

        if(!$buynow_product->delete()){
            return Response::json(['message' => 'An Unknown Error occured, try again'],421);
        }

        return Response::json(['message' => 'success', 'success' => true],202);
    }

    public function gotoPaymentGateway(Request $request, $buynowid){
        
        $buynow = BuyNow::join('buy_now_products','buy_now_products.buy_now_id','=','buy_now.id')->where('buy_now.id', $buynowid)->select('buy_now.*')->first();
        
        if(!$buynow){
            echo 'bad request';
            exit;
        }
        
        $products	    =	BuyNowProducts::where('buy_now_id', $buynow->id)->get();
        
        $extra = 0;
        foreach($products as $buy_products){
            $this->data['add_more_love_products'][$buy_products->id] = DB::table('add_some_more_love_products')->whereIn('id', explode(',',$buy_products->add_more_love_products_id))->get();
            
            foreach($this->data['add_more_love_products'][$buy_products->id] as $add_more_love_product){
                $extra += $add_more_love_product->price;
            }
        }
        
        $product_price  		=	0;
		$weight 				=	0;
		$shippingCharge 		=	200;
		$pincode 				=	Pincode::searchPincode($buynow->shipping_pincode);
		foreach($products as $product){
			$product_price +=  ProductHelper::getVarientPrice($product->upc,$product->varients, $product->product_selling_price) * $product->quantity;
			$weight 	   +=  $weight+intval($product->weight);
		}

		$deliveryWeight  				=	DeliveryWeight::getWeightDomain($weight);

		if($deliveryWeight && $pincode){
    		$shippingPriceData 		=	DeliveryCharges::where('zone_id',$pincode->zone_id )->where('delivery_weight_id', $deliveryWeight['id'])->first();
    		
    		if($shippingPriceData){
    			$shippingCharge     =   $shippingPriceData->price;
    		}
    	}
    	
    	$shippingCharge = DB::table('delivery_methods')->where('alias',$buynow->delivery_option)->first() ? DB::table('delivery_methods')->where('alias',$buynow->delivery_option)->first()->shipping_charge : 0;
    	
    	
    	$data['shippingCharge'] = $shippingCharge;
        $totalAmount = $product_price +$shippingCharge + $extra;

        
        $parameters = [
      
            'tid' => time(),
            
            'order_id' => $buynowid,
            
            'amount' => $totalAmount,
            
            'billing_name' => $buynow->shipping_first_name,
            
            'billing_address' => $buynow->shipping_street_address,
            
            'billing_city' =>  $buynow->shipping_city,
            
            'billing_state' =>  $buynow->shipping_state,
            
            'billing_zip'  =>  $buynow->shipping_pincode,
            
            'billing_country' => 'India',
            
            'billing_tel' =>  $buynow->shipping_mobile,
            
            'billing_email' =>  $buynow->shipping_email,
          ];
          
      $order = Indipay::prepare($parameters);
      return Indipay::process($order);
    }
    
    public function getsuccessresponse(Request $request){
         // For default Gateway
        $response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('NameOfGatewayUsedDuringRequest')->response($request);

        foreach($response as $key => $res){
            $$key = $res;
        }
        
        if($order_status !== 'Success'){
            echo 'transaction not success try again';
            exit;
        }
        
        $buy_now = BuyNow::find($order_id);
        
        if(!$buy_now){
            echo 'some error occured';
            exit;
        }

        $buy_now_products  = BuyNowProducts::where('buy_now_id', $buy_now->id)->get();
        
        $products_arr      = [];
        
        $orderid = [];
        
        foreach($buy_now_products as $key => $buy_now_product){
            
            $order = new Orders;
            $order->customerName = $billing_name;
            $order->customerPhone = $billing_tel ;
            $order->customerEmail = Auth::user() ? Auth::user()->email : $billing_email;
            $order->customerAddress = $billing_address;
            $order->customerCity = $billing_city;
            $order->customerPostCode = $billing_zip;
            $order->customerState = $billing_state;
            $order->shippingName = $delivery_name;
            $order->shippingEmail = $billing_email;
            $order->shippingPhone = $delivery_tel;
            $order->shippingAddress = $delivery_address;
            $order->shippingCity = $delivery_city;
            $order->shippingState = $delivery_state;
            $order->shippingPostCode = $delivery_zip;
            $order->orderAmount      = $amount;
            $order->txnId            = $tracking_id;
            $order->delivery_option = $buy_now_product->delivery_option;
            $order->shipping_time = $buy_now_product->shipping_time;
            $order->selected_delivery_date = $buy_now_product->selected_delivery_date;
            
            if(!$order->save()){
                $products_arr[$key]['order_id'] = $order->id;
                $products_arr[$key]['product_id'] = $buy_now_product->id;
                $products_arr[$key]['product_name'] = $buy_now_product->product_name;
                $products_arr[$key]['product_description'] = $buy_now_product->product_description;
                $products_arr[$key]['varients'] = $buy_now_product->varients;
                $products_arr[$key]['selling_price'] = $buy_now_product->product_selling_price;
                $products_arr[$key]['mrp'] = $buy_now_product->product_mrp;
                $products_arr[$key]['product_weight'] = $buy_now_product->weight;
                $products_arr[$key]['quantity'] = $buy_now_product->quantity;
                $products_arr[$key]['order_by'] = $buy_now_product->product_from;
                $products_arr[$key]['product_image'] = $buy_now_product->image;
                $products_arr[$key]['delivery_option'] = $buy_now_product->delivery_option;
                $products_arr[$key]['shipping_time'] = $buy_now_product->shipping_time;
                $products_arr[$key]['selected_delivery_date'] = $buy_now_product->selected_delivery_date;
                $products_arr[$key]['cover_photo'] = $buy_now_product->cover_photo;
                $products_arr[$key]['paper_color'] = $buy_now_product->paper_color;
                $products_arr[$key]['ink_colour'] = $buy_now_product->ink_colour;
                $products_arr[$key]['emotions'] = $buy_now_product->emotions;
                $products_arr[$key]['receipent_name'] = $buy_now_product->receipent_name;
                $products_arr[$key]['message'] = $buy_now_product->message;
                $products_arr[$key]['has_add_more_love'] = $buy_now_product->has_add_more_love;
                $products_arr[$key]['add_more_love_products_id'] = $buy_now_product->add_more_love_products_id;
            }
            
            $orderid[] = $order->id;
        }
        
        $insertProduct = DB::table('order_products')->insert($products_arr);
        
        if(!$insertProduct){
            echo 'unknown error occured. Mail us your chekout id which is '.$buy_now. ' and we will process your order';
            exit;
        }
        
        return redirect('/order/success/'.implode(',',$orderid));
    }
    
    public function getcancelresponse(Request $request){
         // For default Gateway
        $response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('NameOfGatewayUsedDuringRequest')->response($request);

        return redirect('/order/fail');
    }
    
    public function ordersuccess(Request $request, $orderid){
        
        if(!$order = Orders::find($orderid)){
            echo 'invalid request';
            exit;
        }
        
        $this->data['orderid'] = $orderid;

        Mail::send('emails.ordersuccess', ['order' => $order], function ($m) use ($order) {
            $m->from('payments@techturtle.in', 'Massengers');

            $m->to($order->customerEmail,$order->customerName)->subject('Order Placed Successfully');
        });
        
        return view('massengers/checkout/payment_success', $this->data);
    }
}
