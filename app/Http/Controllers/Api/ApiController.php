<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, Response;
use App\Models\Orders\Orders;
use App\Models\Shipping\Pincode;
use App\Models\Shipping\DeliveryWeight;
use App\Models\Shipping\DeliveryCharges;
use App\Models\OrderReturn\ReturnRequest;
use Carbon\Carbon;
use App\Models\Orders\OrderProducts, Auth;

class ApiController extends Controller{
    

    public function __construct(){}

    public static function is_active(){
    	/*
			after modify the api setting module this function will be modified
			It check if the api is enabled for user or not..?
			It will give us boolean as return. 
			If api is enabled it return true or 1 otherwise it will give false or 0
    	*/
    	return true;
    }

    public static function checkToken($token){
    	
    	/*
			after modify the api setting module this function will be modified
			This check for tocken is exist on digishoppers database or not. ?
			If the tocken exist 	
    	*/
		$result 	=	false;
		if(in_array($token, ['A123456'])){
			$result =   true;
		}
    	return $result; 
    }

    public function show_place_order_html(Request $request){
    	
    	return view('api/order/place_order');
    }

    public function place_order(Request $request){

    	if(!self::is_active()){
    		return Response::json(['error' => 1, 'message' => 'api is not active', 'data' => array()]);
    		exit;
    	}

    	$requiredFieldArray 	              =	[
    		'access_token'		             => 'userId',
    		'customer_name' 	             => 'customerName',
    		'customer_phone'	             => 'customerPhone',
    		'customer_email'                 => 'customerEmail',
    		'customer_street_address'        => 'customerAddress',
    		'customer_city'		             => 'customerCity',
    		'customer_pincode'	             => 'customerPostCode',
    		'customer_state'	             => 'customerState',
    		'shipping_name'		             => 'shippingName',
    		'shipping_email'	             => 'shippingEmail',
    		'shipping_phone'	             =>	'shippingPhone',
    		'shipping_street_address'	     =>	'shippingAddress',
    		'shipping_city'		             =>	'shippingCity',
    		'shipping_state'	             =>	'shippingState',
    		'shipping_pincode'	             =>	'shippingPostCode',
    		'order_amount'		             =>	'orderAmount',
    		'payment_type'		             =>	'paymentType',
    		'txnid'				             =>	'txnId',
            'weight'                         => 'product_weight',
            'seller_id'                      => 'seller_id',
    	];

    	foreach($requiredFieldArray as $field => $display_value){
    		if(!$request->has($field)){
	    		return Response::json(['error' => 1, 'message' => $field.' is required field', 'data' => array()]);
	    		exit;
    		}

    		if(!strcmp($field,'customer_email') || !strcmp($field,'shipping_email')){
    			if(filter_var($request->$field, FILTER_VALIDATE_EMAIL) === false){
		    		return Response::json(['error' => 1, 'message' => $field.' must be correct email', 'data' => array()]);
		    		exit;
		    	}
    		}
    	}

    	foreach($request->all() as $key => $value){
    		$$key				=	$value;
    	}

    	if(!self::checkToken($access_token)){
    		return Response::json(['error' => 1, 'message' => 'Invalid Access token', 'data' => array()]);
    		exit;
    	}

    	$calculateShippingCharge 	=	true;
    	$pincode 					=	Pincode::searchPincode($shipping_pincode);
    	$shippingCharge 			=	0;

    	if(!$pincode){
    		$calculateShippingCharge = false;
    	}
    	
    	$deliveryWeight 			=	DeliveryWeight::getWeightDomain($weight);

    	if($calculateShippingCharge && $deliveryWeight ){
    		$shippingPriceData 		=	DeliveryCharges::where('zone_id',$pincode->zone_id )->where('delivery_weight_id', $deliveryWeight['id'])->first();
    		
    		if($shippingPriceData){
    			$shippingCharge     =   $shippingPriceData->price;
    		}
    	}

    	$order 						=	new Orders;

    	foreach($requiredFieldArray as $field => $attribute_name){
    		$order->$attribute_name = 	$$field;
    	}
    	    	
    	$order->order_type 			= 	'api';
        $order->shippingCharge      =   $shippingCharge;

    	if(!$order->save()){
    		return Response::json(['error' => 1, 'message' => 'Order Cant saved try again', 'data' => array()]);
    		exit;
    	}	

    	$result 					=	[
    		'order_id' 			=> $order->id, 
    		'order_placed_time' => $order->created_at,
    		'shipping_charge'	=> $shippingCharge,
    		'product_name'		=> $order->product,
    		'product_varient'	=> $order->varient,
    	];
    	return Response::json(['error' => 0, 'message' => 'Success', 'data' => $result]);
    }

    public function show_return_order_html(Request $request){
        return view('api/return/place_return');
    }

    public function place_return(Request $request){
        
        if(!self::is_active()){
            return Response::json(['error' => 1, 'message' => 'api is not active', 'data' => array()]);
            exit;
        }

        $requiredFieldArray     =   [
            'access_token'      => 'userId',
            'order_id'          => 'id',
            'reason_of_return'  => 'reason_of_return',
        ];

        foreach($requiredFieldArray as $field => $display_value){
            if(!$request->has($field)){
                return Response::json(['error' => 1, 'message' => $field.' is required field', 'data' => array()]);
                exit;
            }
        }

        foreach($request->all() as $key => $value){
            $$key               =   $value;
        }

        if(!self::checkToken($access_token)){
            return Response::json(['error' => 1, 'message' => 'Invalid Access token', 'data' => array()]);
            exit;
        }

        $order                  =   Orders::find($order_id);
        if(!$order){
            return Response::json(['error' => 1, 'message' => 'Order does not exist', 'data' => array()]);
            exit;
        }

        $order->status          =   'return';

        if(!$order->save()){
            return Response::json(['error' => 1, 'message' => 'Return status cant changed', 'data' => array()]);
            exit;
        }

        if(ReturnRequest::where('oid', $order->id)->first()){
            return Response::json(['error' => 1, 'message' => 'Product already returned', 'data' => array()]);
            exit;
        }

        $return                 =   new ReturnRequest;
        $return->oid            =   $order_id;
        $return->comment        =   $reason_of_return;
        $return->recordInsertedDate =   Carbon::now();

        if(!$return->save()){
            return Response::json(['error' => 1, 'message' => 'Return Cant Placed', 'data' => array()]);
            exit;
        }

        $result                     =   [
            'order_id'          => $order->id, 
            'return_id'         => $return->id,
            'reason'            => $return->comment,
            'return_placed_time'=> $return->recordInsertedDate,
        ];
        return Response::json(['error' => 0, 'message' => 'Success', 'data' => $result]);
    }

    public function show_update_order_product(Request $request){
        return view('api/order_product/save_order_product');
    }

    public function save_order_product(Request $request){
        if(!self::is_active()){
            return Response::json(['error' => 1, 'message' => 'api is not active', 'data' => array()]);
            exit;
        }

        $requiredFieldArray     =   [
            'access_token'          => 'userId',
            'order_id'              => 'order_id',
            'product_id'            => 'product_id',
            'product_name'          => 'product_name',
            'product_description'   => 'product_description',
            'varients'              => 'varients',
            'mrp'                   => 'mrp',
            'product_weight'        => 'product_weight',
            'quantity'              => 'quantity',
            'product_type'          => 'product_type',
            'selling_price'         => 'selling_price',
            'category_id'           => 'category_id',
            'order_by'              => 'order_by',
            'varients'              => 'varients',
        ];

        foreach($requiredFieldArray as $field => $display_value){
            if(!$request->has($field)){
                return Response::json(['error' => 1, 'message' => $field.' is required field', 'data' => array()]);
                exit;
            }
        }

        foreach($request->all() as $key => $value){
            $$key               =   $value;
        }

        if(!self::checkToken($access_token)){
            return Response::json(['error' => 1, 'message' => 'Invalid Access token', 'data' => array()]);
            exit;
        }

        $order                  =   Orders::find($order_id);
        if(!$order){
            return Response::json(['error' => 1, 'message' => 'Order does not exist', 'data' => array()]);
            exit;
        }

        $order_product                          =   new OrderProducts;
        $order_product->order_id                =   $order_id;
        $order_product->product_id              =   $product_id;
        $order_product->product_name            =   $product_name;
        $order_product->product_description     =   $product_description;
        $order_product->varients                =   $varients;
        $order_product->selling_price           =   $selling_price;
        $order_product->mrp                     =   $mrp;
        $order_product->product_weight          =   $product_weight;
        $order_product->quantity                =   $quantity;
        $order_product->product_type            =   $product_type;
        $order_product->category_id             =   $category_id;
        $order_product->order_by                =   $order_by;

        if(!$order_product->save()){
            return Response::json(['error' => 1, 'message' => 'product cant saved', 'data' => array()]);
            exit;
        }

        return Response::json(['error' => 0, 'message' => 'Success', 'data' => '']);
    }

    public function getlogin(Request $request){
        $auth = false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $auth = true;
        }

        return Response::json(array('success' => $auth));
    }
}
