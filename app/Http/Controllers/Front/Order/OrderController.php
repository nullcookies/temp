<?php

namespace App\Http\Controllers\Front\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller, Response;
use App\Models\Api\ApiProduct;
use App\Models\Product\Product;
use App\Models\Varient\SelectedVarient, DB;
use App\Models\Checkout\BuyNow;
use App\Models\Checkout\BuyNowProducts;
use App\Models\Address\Address, Auth;
use App\Traits\CommissionType;
use App\Models\Orders\Orders;
use App\Models\Orders\OrderProducts;
use App\Models\Coupon\Coupon;
use App\Models\Coupon\AssignedCoupon;
use App\Models\Shipping\Pincode;
use App\Models\Shipping\DeliveryWeight;
use App\Models\Shipping\DeliveryCharges;
use App\Helper\SmsHelper;
use App\Models\ProductImage\ProductImage;
use App\Http\Requests\Order\PlaceReturnRequest, Carbon\Carbon;
use App\Models\Categories_commission\Categories_commission;
use App\Models\CommossionType\StandardCommission;
use App\User;

class OrderController extends Controller{
	   
	use CommissionType;
	public $data;
	protected $sms;
	public function __construct(){
		$this->data 	=	array();
		$this->sms      =   new SmsHelper;
	}

	public function preparebuynow(Request $request){

		if(!$request->ajax()){
			exit;
		}

		if(!$request->has('product_from') 
			|| !$request->has('qty')
			|| !in_array($request->product_from, ['api','normal'])
			|| !$request->has('product_id')){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'invalid form parameters'));
			exit;
		}

		if(!(in_array($request->product_from,['api'])?ApiProduct::where('api_product_id', $request->product_id)->first(): Product::find($request->product_id))){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Product Not exist'));
			exit;
		}

		if(!is_numeric($request->qty) || $request->qty <1) {
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Invalid quantity.'));
			exit;
		}

		$varients 				=	'';

		if(in_array($request->product_from, ['normal'])){
			$productVarients        =  SelectedVarient::join('varient_types','varient_types.id','=','selected_varient_for_product.varient_type_id')->where('product_id',$request->product_id)->groupBy('varient_type_id')->select('varient_types.varient_type','varient_types.id')->get();

			$terminate 			=	false;
			$varientValues      =   array();
			$varientTypeValIds 		=	array();
			if($productVarients){

				foreach($productVarients as $productVarient){
					$varientName = ($productVarient->varient_type);
					$varientTypeValIds[] = $request->$varientName;
					$varientValues[] = array('varient_type' => $request->$varientName, 'varient_id' => $productVarient->id);
					if(!isset($request->$varientName)){ // || $request->$varientName != $productVarient->id
						$terminate  =   true;
					}	
				}
			}

			if($terminate){
				return Response::json(['fail' => 'true', 'class' => 'danger', 'message' => 'Select all Varients']);
				exit;
			}

			$varientTypeValueNames 	=	DB::table('varient_type_values')->whereIn('id',$varientTypeValIds)->get();

			foreach($varientTypeValueNames as $varientTypeValueName){
				$varients           .=  $varientTypeValueName->value.',';
			}
		}

		if(in_array($request->product_from, ['api'])){
			if(!$request->has('varients')){
				return Response::json(['fail' => 'true', 'class' => 'danger', 'message' => 'Please select varient']);
				exit;
			}

			$varients = $request->varients;			
		}

		$productObj 				 =	!in_array($request->product_from, ['api']) ? Product::where('id',$request->product_id)->where('quantity','>=',$request->qty) : ApiProduct::where('api_product_id',$request->product_id);
		$productObj 				 =  !in_array($request->product_from, ['api']) ? $productObj->select('id as upc','product_name','product_description','product_mrp','product_selling_price','weight as product_weight') : $productObj->select('api_product_id as upc','productTitle as product_name','description as product_description','mrp as product_mrp','sellingPrice as product_selling_price','weight as product_weight','categoryId','expected_payout');
		$desiredProduct 			 =	$productObj->first();
		
		if(!$desiredProduct){
			return Response::json(['fail' => 'true', 'class' => 'danger', 'message' => 'Sorry this product is out of stock']);
			exit;
		}
    
        /* new */
		$commissionType = self::commissionType();
		$product_price               =  $desiredProduct->product_selling_price;
		$commission_perc             =  0;
		if(in_array($request->product_from, ['api'])){
			if(in_array($commissionType, ['standard_commission','category_commission'])){
                if($commissionType == 'category_commission'){
                    $catComm = Categories_commission::where('category_id',$desiredProduct->categoryId)->first();
                    $commission_perc = $catComm ? $catComm->price : $commission_perc;
                }else{
                    $standComm = StandardCommission::where('min','<',$desiredProduct->expected_payout)->where('max','>',$desiredProduct->expected_payout)->first();
                    $commission_perc = $standComm ? $standComm->commission : $commission_perc;
                }
            }
            $product_price   = intval(($desiredProduct->expected_payout * (100 +$commission_perc))/100);
		}

		/* new */
    
		$buyNow 					 =	new BuyNow;
		if(!$buyNow->save()){
			return Response::json(['fail' => 'true', 'class' => 'danger', 'message' => 'Sry try again']);
			exit;
		}

		$buyNowProduct 				 			=	new BuyNowProducts;
		$buyNowProduct->upc 				 	=	$desiredProduct->upc;
		$buyNowProduct->product_name 		 	=	$desiredProduct->product_name;
		$buyNowProduct->product_description 	=	$desiredProduct->product_description;
		$buyNowProduct->product_mrp 	     	=	$desiredProduct->product_mrp;
		$buyNowProduct->product_selling_price 	=	$product_price;//$desiredProduct->product_selling_price;
		$buyNowProduct->varients 			 	=	$varients;
		$buyNowProduct->product_from 		 	=	$request->product_from;
		$buyNowProduct->buy_now_id 			 	=	$buyNow->id;
		$buyNowProduct->quantity                =   $request->qty;
		$buyNowProduct->weight 					=	$desiredProduct->weight;
		if(!$buyNowProduct->save()){
			return Response::json(['fail' => 'true', 'class' => 'danger', 'message' => 'Sry try again']);
			exit;
		}
		
		//dd(BuyNowProducts::where('buy_now_id',$buyNow->id)->count());

		return Response::json(array('success' => true, 'class' => 'success','varients' => $varients , 'product' => $desiredProduct, 'message' => 'Success','buynowid' => base64_encode($buyNow->id)));
	}

	public function showCheckout(Request $request){

		if(!$request->has('buynow')){
			echo 'invalid parameters';
			exit;
		}

		$buyNowId = base64_decode($request->buynow);
		$buynow   = BuyNow::find($buyNowId);
		
		if(!$buynow){
			echo 'invalid parameters';
			exit;
		}

		$this->data['buynow']		=	$buynow;
		$this->data['addresses']	=	Auth::user() ? Address::where('user_id', Auth::user()->id)->get() : array();
		$this->data['products']	    =	BuyNowProducts::where('buy_now_id', $buynow->id)->get();

		foreach($this->data['products'] as $buynowproduct){
			$myproduct   =   array();

            if($buynowproduct->product_from == 'api'){
                $myproduct   =   ApiProduct::where('api_product_id', $buynowproduct->upc)->select('api_product_id as id','productTitle as product_name','description as product_description','sellingPrice as product_selling_price','mrp as product_mrp','product_images')->first();
            }else{
                $myproduct   =   Product::where('id', $buynowproduct->upc)->select('id','product_name','product_description','product_selling_price','product_mrp')->first();
            }

            $productImage        =  DB::table('product_images')
            ->where ('product_id', $buynowproduct->upc)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            if($buynowproduct->product_from == 'api'){
                $this->data['productImage'][$buynowproduct->upc] =  explode(',',$myproduct->product_images)[0];
            }else{
                $this->data['productImage'][$buynowproduct->upc] = ($productImage && \File::exists(public_path('/product_images/100x100/'.$productImage->image))) ? url('/product_images/100x100/'.$productImage->image) : url('no_image.png'); 
            }
		}

		//dd($this->data['products']);

		$product_price  		=	0;
		$weight 				=	0;
		$shippingCharge 		=	0;
		$pincode 				=	Pincode::searchPincode($buynow->shipping_pincode);
		foreach($this->data['products'] as $product){
			$product_price +=  $product->product_selling_price * $product->quantity;
			$weight 	   +=  $weight+intval($product->weight);
		}

		$deliveryWeight  				=	DeliveryWeight::getWeightDomain($weight);

		if($deliveryWeight && $pincode){
    		$shippingPriceData 		=	DeliveryCharges::where('zone_id',$pincode->zone_id )->where('delivery_weight_id', $deliveryWeight['id'])->first();
    		
    		if($shippingPriceData){
    			$shippingCharge     =   $shippingPriceData->price;
    		}
    	}

    	$buynow->shipping_price 	=	$shippingCharge;//dd($buynow);
    	$buynow->save();

    	if($buynow->free_shipping == 'yes'){
    		$shippingCharge 		=	0;
    	}

    	$product_price 				+=	$shippingCharge;

    	$this->data['beforeCoupon']	=	$product_price+$buynow->shipping_price;

		$this->data['totalCart']   		= $product_price;

		if($buynow->applied_coupon_code == 'yes'){
			$this->data['totalCart']        =	$this->data['totalCart'] - $buynow->discount;
		}

		if($request->isMethod('post') && $this->data['buynow']->selected_payment_method == 'cod'){
			$txnid 						=	md5(time());
			$buynow 					=	$this->data['buynow']; 	
			$order 						=	new Orders;
			$customerFullName 			=	$buynow->billing_first_name.' '.$buynow->billing_last_name;
			$shippingFullName 			=	$buynow->shipping_first_name.' '.$buynow->shipping_last_name;

			$order->customerName 		=	$customerFullName;
			$order->customerPhone 		=	$buynow->billing_mobile;
			$order->customerEmail 		=	$buynow->billing_email;
			$order->customerAddress 	=	$buynow->billing_street_address;
			$order->customerCity 		=	$buynow->billing_city;
			$order->customerState 		=	$buynow->billing_state;
			$order->customerPostCode 	=	$buynow->billing_pincode;
			$order->shippingName 		=	$shippingFullName;
			$order->shippingEmail 		=	$buynow->shipping_email;
			$order->shippingPhone 		=	$buynow->shipping_mobile;
			$order->shippingAddress 	=	$buynow->shipping_street_address;

			$order->shippingCity 		=	$buynow->shipping_city;
			$order->shippingState 		=	$buynow->shipping_state;
			$order->shippingPostCode 	=	$buynow->shipping_pincode;
			$order->userId 				=	Auth::user() ? Auth::user()->email :$buynow->billing_email;

			$order->apply_coupen_id 	=	$buynow->coupon_code_id ? $buynow->coupon_code_id: 0 ;
			$order->apply_coupon 		=	$buynow->coupon_code ? $buynow->coupon_code : 0 ;
			$order->coupon_amount 		=	$buynow->discount ? $buynow->discount : 0 ;

			$products					=	BuyNowProducts::where('buy_now_id', $buynow->id)->get();


			/*$product_price  			=	0;
			foreach($products as $product){
				$product_price +=  $product->product_selling_price * $product->quantity;
			}

			$totalCart   				=	$product_price+($buynow->shipping_price);

			if($buynow->applied_coupon_code == 'yes'){
				$totalCart        		=	$totalCart - $buynow->discount;
			}*/

			$totalCart 					=	$this->data['totalCart'];

			$order->orderAmount 		=	$totalCart;
			$order->shippingCharge 		=	intval($buynow->shipping_price);
			$order->paymentType 		=	$buynow->selected_payment_method;
			$order->txnId 				=	$txnid;
			$order->payu_txnid 			=	$txnid;

			if(!$order->save()){
				dd('order cant saved');
			}

			foreach($products as $product){

				$productImage           =   '';
				if($product->product_from == 'normal'){
					$productImage       =   ProductImage::where('default_image','yes')->where('product_id', $product->upc)->first() ? url('product_images/'.ProductImage::where('default_image','yes')->where('product_id', $product->upc)->first()->image) : '' ;
				    DB::table('product')->where('id',$product->upc)->where('substract_stock','yes')->increment('quantity','-'.$product->quantity);
				    
				}else{
					$productImage       =   explode(',',ApiProduct::where('api_product_id', $product->upc)->first()->product_images)[0];
				}

				$order_product 						=	new OrderProducts;
				$order_product->order_id			=	$order->id;
				$order_product->product_name		=	$product->product_name;
				$order_product->varients			=	$product->varients;
				$order_product->product_description	=	$product->product_description;
				$order_product->selling_price		=	$product->product_selling_price;
				$order_product->mrp					=	$product->product_mrp;
				$order_product->product_weight		=	0;
				$order_product->quantity			=	$product->quantity;
				$order_product->product_id 			=	$product->upc;
				$order_product->product_type 		=	$product->product_from;
				$order_product->product_image       =   $productImage;
				
				$order_product->save();
			}

			//$buynow->delete();

			return redirect('/order/orderSuccess/'.base64_encode($order->id));
			exit;
		}

		return view('front/checkout/checkout', $this->data);
	}

	public function commonForBillingShipping($request){
		if(!$request->ajax()){
			exit;
		}

		if(!$request->has('buynowid')){
			exit;
		}

		$buynow 	=	BuyNow::where('id', $request->buynowid)->first();
		
		if(!$buynow){
			exit;
		}

		$this->data['buynow']		=	$buynow;
		
	}

	public function showBillingAddress(Request $request){
		self::commonForBillingShipping($request);
		$this->data['addresses']	=	Auth::user() ? Address::where('user_id', Auth::user()->id)->get() : array();
		return view('front/checkout/ajax/billing_address', $this->data);
	}


	public function showShippingAddress(Request $request){
		self::commonForBillingShipping($request);
		$this->data['addresses']	=	Auth::user() ? Address::where('user_id', Auth::user()->id)->get() : array();
		return view('front/checkout/ajax/shipping_address', $this->data);
	}

	public function show_payment_method(Request $request){
		self::commonForBillingShipping($request);
		return view('front/checkout/ajax/payment_method', $this->data);
	}

	public function show_payment_info(Request $request){
		self::commonForBillingShipping($request);

		$this->data['products']	=	BuyNowProducts::where('buy_now_id', $request->buynowid)->get();


		$product_price  		=	0;
		foreach($this->data['products'] as $product){
			$product_price+=  $product->product_selling_price * $product->quantity;
		}

		$this->data['totalCart']   			=	$product_price+$this->data['buynow']->shipping_price;
		return view('front/checkout/ajax/payment_information', $this->data);
	}

	public function show_checkout_sidebar(Request $request){
		self::commonForBillingShipping($request);
		return view('front/checkout/ajax/right_sidebar', $this->data);
	}

	public function getbuyNowDetail(Request $request){
		self::commonForBillingShipping($request);
		return response::json(array('success' => true, 'data' => $this->data['buynow']));
	}

	public function select_address(Request $request){
		if(!$request->ajax()){
			exit;
		}

		if(!$request->has('addressid')){
			exit;
		}

		if(!Auth::user()){
			exit;
		}

		$this->data['addresses']	=	Address::where('id', $request->addressid)->first();

		if(!$this->data['addresses']){
			return Response::json(array('fail' => true));
		}

		return Response::json(array('success' => true, 'data' => $this->data['addresses']));
	}

	public function saveBilingAddress(Request $request){
		if(!$request->ajax()){
			exit;
		}

		if(!isset($request->buynowid)){
			return Response::json(array('fail' => true, 'message' => 'buynowid parameter is missing', 'class' => 'danger'));
		}

		$buynow 	=	BuyNow::where('id', $request->buynowid)->first();
		
		if(!$buynow){
			return Response::json(array('fail' => true, 'message' => 'Go to checkout page and start checkout process again', 'class' => 'danger'));
		}

		$parms 		=	[
			"billing_first_name",
			"billing_last_name",
			"billing_email",
			"billing_mobile",
			"billing_pincode",
			"billing_state",
			"billing_city",
			"billing_country",
			"billing_street_address"
		];

		foreach($parms as $parm){
			if(!$request->has($parm)){
				return Response::json(array('fail' => true, 'message' => $parm.' is a required field', 'class' => 'danger'));
			}

			if($parm == 'billing_email' && filter_var($request->$parm, FILTER_VALIDATE_EMAIL) === false){
				return Response::json(array('fail' => true, 'message' => $parm.' Should be a proper email id', 'class' => 'danger'));
			}	

			if($parm == 'billing_mobile' && !preg_match('/[2-9]{2}\d{8}/', $request->$parm)){
				return Response::json(array('fail' => true, 'message' => $parm.' should be 10 digit numeric correct mobile number', 'class' => 'danger'));
			}
		}

		foreach($parms as $parm){
			$buynow->$parm 	=	$request->$parm;
		}

		$buynow->init 				=	'no';
		$buynow->billing_address 	=	'no';
		$buynow->shipping_address 	=	'yes';

		if(!$buynow->save()){
			return Response::json(array('fail' => true, 'message' => 'try again saving billing address', 'class' => 'danger'));
		}

		return Response::json(array('success' => true, 'message' => 'success', 'class' => 'success'));
	}

	public function saveShippingAddress(Request $request){
		if(!$request->ajax()){
			exit;
		}

		if(!isset($request->buynowid)){
			return Response::json(array('fail' => true, 'message' => 'buynowid parameter is missing', 'class' => 'danger'));
		}

		$buynow 	=	BuyNow::where('id', $request->buynowid)->first();
		
		if(!$buynow){
			return Response::json(array('fail' => true, 'message' => 'Go to checkout page and start checkout process again', 'class' => 'danger'));
		}

		$parms 		=	[
			"shipping_first_name",
			"shipping_last_name",
			"shipping_email",
			"shipping_mobile",
			"shipping_pincode",
			"shipping_state",
			"shipping_city",
			"shipping_country",
			"shipping_street_address"
		];

		foreach($parms as $parm){
			if(!$request->has($parm)){
				return Response::json(array('fail' => true, 'message' => $parm.' is a required field', 'class' => 'danger'));
			}

			if($parm == 'shipping_email' && filter_var($request->$parm, FILTER_VALIDATE_EMAIL) === false){
				return Response::json(array('fail' => true, 'message' => $parm.' Should be a proper email id', 'class' => 'danger'));
			}	

			if($parm == 'shipping_mobile' && !preg_match('/[2-9]{2}\d{8}/', $request->$parm)){
				return Response::json(array('fail' => true, 'message' => $parm.' should be 10 digit numeric correct mobile number', 'class' => 'danger'));
			}
		}

		foreach($parms as $parm){
			$buynow->$parm 	=	$request->$parm;
		}

		$buynow->init 				=	'no';
		$buynow->billing_address 	=	'no';
		$buynow->shipping_address 	=	'no';
		$buynow->payment_method 	=	'yes';

		if(!$buynow->save()){
			return Response::json(array('fail' => true, 'message' => 'try again saving shipping address', 'class' => 'danger'));
		}
		
		if(Auth::user()){
			$address 				= new Address(); 
			$address->first_name 	= $buynow->shipping_first_name;
			$address->last_name 	= $buynow->shipping_last_name;
			$address->email 		= $buynow->shipping_email;
			$address->mobile 		= $buynow->shipping_mobile;
			$address->pincode 		= $buynow->shipping_pincode;
			$address->state 		= $buynow->shipping_state;
			$address->city 			= $buynow->shipping_city;
			$address->country 		= $buynow->shipping_country;
			$address->address 		= $buynow->shipping_street_address;
			$address->user_id 		= Auth::user()->id;			
			if(!$address->save()){
				return Response::json(array('fail' => true, 'message' => 'Try again saving shipping address', 'class' => 'danger'));
			}
		}
		

		return Response::json(array('success' => true, 'message' => 'success', 'class' => 'success'));
	}

	public function save_payment_method(Request $request){
		if(!$request->ajax()){
			exit;
		}

		if(!isset($request->buynowid)){
			return Response::json(array('fail' => true, 'message' => 'buynowid parameter is missing', 'class' => 'danger'));
		}

		$buynow 	=	BuyNow::where('id', $request->buynowid)->first();
		
		if(!$buynow){
			return Response::json(array('fail' => true, 'message' => 'Go to checkout page and start checkout process again', 'class' => 'danger'));
		}

		$parms 		=	[
			"selected_payment_method",
		];

		foreach($parms as $parm){
			if(!$request->has($parm)){
				return Response::json(array('fail' => true, 'message' => 'Please select a payment method', 'class' => 'danger'));
			}

			if(!in_array($request->$parm, ['cod','online'])){
				return Response::json(array('fail' => true, 'message' => 'Invalid Parameter', 'class' => 'danger'));
			}
		}

		foreach($parms as $parm){
			$buynow->$parm 	=	$request->$parm;
		}

		$buynow->init 				=	'no';
		$buynow->billing_address 	=	'no';
		$buynow->shipping_address 	=	'no';
		$buynow->payment_method 	=	'no';
		$buynow->payment_method 	=	'no';
		$buynow->payment_info 		=	'yes';

		if(!$buynow->save()){
			return Response::json(array('fail' => true, 'message' => 'Payment Method', 'class' => 'danger'));
		}
		return Response::json(array('success' => true, 'message' => 'success', 'class' => 'success'));
	}


	public function getSuccess(Request $request){
		
		foreach($request->all() as $key => $value){
			$$key = $value;
		}

		if( !isset($mihpayid) 
			|| !isset($status)
			|| !isset($txnid)
			|| !isset($amount)
			|| !isset($net_amount_debit)
			|| !isset($addedon)
			|| !isset($productinfo)
			|| !isset($firstname)
			|| !isset($lastname)
			|| !isset($address1)
			|| !isset($state)
			|| !isset($city)
			|| !isset($country)
			|| !isset($zipcode)
			|| !isset($email)
			|| !isset($phone)
			|| !isset($udf1)
			|| !isset($udf2)
			|| !isset($udf3)
			|| !isset($udf4)
			|| !isset($udf5)
			|| !isset($udf6)
			|| !isset($bank_ref_num)){
			die('invalid request');
		}

		if($status !== 'success'){
			dd('payment not success');
		}

		$buynow 					=	BuyNow::find($udf1);

		$order 						=	new Orders;

		$customerFullName 			=	$buynow->billing_first_name.' '.$buynow->billing_last_name;
		$shippingFullName 			=	$buynow->shipping_first_name.' '.$buynow->shipping_last_name;

		$order->customerName 		=	$customerFullName;
		$order->customerPhone 		=	$buynow->billing_mobile;
		$order->customerEmail 		=	$buynow->billing_email;
		$order->customerAddress 	=	$buynow->billing_street_address;
		$order->customerCity 		=	$buynow->billing_city;
		$order->customerState 		=	$buynow->billing_state;
		$order->customerPostCode 	=	$buynow->billing_pincode;
		$order->shippingName 		=	$shippingFullName;
		$order->shippingEmail 		=	$buynow->shipping_email;
		$order->shippingPhone 		=	$buynow->shipping_mobile;
		$order->shippingAddress 	=	$buynow->shipping_street_address;
		$order->paymentType			=	$buynow->selected_payment_method;

		$order->shippingCity 		=	$buynow->shipping_city;
		$order->shippingState 		=	$buynow->shipping_state;
		$order->shippingPostCode 	=	$buynow->shipping_pincode;
		$order->userId 				=	Auth::user() ? Auth::user()->email :$buynow->billing_email;

		$order->apply_coupen_id 	=	$buynow->coupon_code_id ? $buynow->coupon_code_id: 0 ;
		$order->apply_coupon 		=	$buynow->coupon_code ? $buynow->coupon_code : 0 ;
		$order->coupon_amount 		=	$buynow->discount ? $buynow->discount : 0 ;


		$products					=	BuyNowProducts::where('buy_now_id', $buynow->id)->get();


		$product_price  			=	0;
		foreach($products as $product){
			$product_price +=  $product->product_selling_price * $product->quantity;
		}

		$shippingPrice 				=	$buynow->shipping_price;

		if($buynow->free_shipping == 'yes'){
			$shippingPrice 			=	0;
		}

		$totalCart   				=	$product_price+$shippingPrice;

		if($buynow->applied_coupon_code == 'yes'){
			$totalCart        		=	$totalCart - $buynow->discount;
		}

		$order->orderAmount 		=	$totalCart;
		$order->shippingCharge 		=	intval($buynow->shipping_price);
		$order->paymentType 		=	$buynow->selected_payment_method;
		$order->txnId 				=	$txnid;
		$order->payu_txnid 			=	$txnid;

		if(!$order->save()){
			dd('order cant saved');
		}

		foreach($products as $product){

			$productImage           =   '';
			if($product->product_from == 'normal'){
				$productImage       =   ProductImage::where('default_image','yes')->where('product_id', $product->upc)->first() ? url('product_images/'.ProductImage::where('default_image','yes')->where('product_id', $product->upc)->first()->image) : '' ;
			    DB::table('product')->where('id',$product->upc)->where('substract_stock','yes')->increment('quantity','-'.$product->quantity);
			    
			}else{
				$productImage       =   explode(',',ApiProduct::where('api_product_id', $product->upc)->first()->product_images)[0];
			}

			$order_product 						=	new OrderProducts;
			$order_product->order_id			=	$order->id;
			$order_product->product_name		=	$product->product_name;
			$order_product->varients			=	$product->varients;
			$order_product->product_description	=	$product->product_description;
			$order_product->selling_price		=	$product->product_selling_price;
			$order_product->mrp					=	$product->product_mrp;
			$order_product->product_weight		=	0;
			$order_product->quantity			=	$product->quantity;
			$order_product->product_id 			=	$product->upc;
			$order_product->product_type 		=	$product->product_from;
			$order_product->product_image       =   $productImage;
			$order_product->save();
		}

		//$buynow->delete();
		return redirect('/order/orderSuccess/'.base64_encode($order->id));
	}

	public function showSuccessMessage(Request $request, $orderid){
		$orderid 				=	base64_decode($orderid);
		$order 					=	Orders::find($orderid);
		if(!$order){
			dd('order not exist');
		}

		$order->payu_trans 		= 	base64_encode($orderid);
		$order->save();
		
		if($order->saved_awb_number == 'no'){
		    $url        =   "https://admin.techturtle.in/api/getAwb?token=tdrq55qqxgs&salt=8765rtftg";
            //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $result= curl_exec($ch);
    
            if(!$result){
                return false;
                exit;
            }
            
            curl_close($ch);
            $awb_number = json_decode($result);
            
            if(isset($awb_number->status) && $awb_number->status){
                $order->awb_number = $awb_number->awb;
                $order->saved_awb_number = 'yes';
            }
            $order->save();
		}

		if($order->saved_to_server == 'no'){
			$tocken 	=	"A123456"; // Enter the given token

			$url 		=	"https://admin.techturtle.in/api/order_api";   // replace with given url

			$parametersArray 	=	[ //  below all the parameters are manditory.
				'access_token'				=>  $tocken,
				'customer_name' 			=> 	$order->customerName,
				'customer_phone'			=> 	$order->customerPhone,
				'customer_email'    		=> 	$order->customerEmail,
				'customer_street_address' 	=> 	$order->customerAddress,
				'customer_city'				=> 	$order->customerCity,
				'customer_pincode'			=>  $order->customerPostCode,
				'customer_state'			=>  $order->customerState,
				'shipping_name'				=>  $order->shippingName,
				'shipping_email'			=>  $order->shippingEmail,
				'shipping_phone'			=>	$order->shippingPhone,
				'shipping_street_address'	=>	$order->shippingAddress,
				'shipping_city'				=>	$order->shippingCity,
				'shipping_state'			=>	$order->shippingState,
				'shipping_pincode'			=>	$order->shippingPostCode,
				'order_amount'				=>	$order->orderAmount,
				'payment_type'				=>	'cod',
				'txnid'						=>	$order->txnId,
				'weight'                    =>  0,
				'seller_id'   				=>	1,
				'website_link'              =>  url('/'),
				'client_order_id'           =>  $order->id,
				'awb_number'                =>  $order->awb_number,
			] ;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parametersArray));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec ($ch);
			curl_close ($ch);

			if(!$server_output){
				echo json_encode(array('error' => 1, 'message' => 'check your code there are some problems', 'data' => []));
				exit;
			}

			$placed_order 					=	json_decode($server_output);

			$api_order_id 					=	$placed_order->data->order_id;
			
			$products 						=	OrderProducts::where('order_id', $order->id)->get();

			foreach($products as $product){
				$tocken 	=	"A123456"; // Enter the given token

				$url 		=	"https://admin.techturtle.in/api/order_product_api";    // replace with given url
                
                $seller_id  = 0;
				
				if($product->product_type == 'api'){
				    $prodata = DB::table('api_products')->where('api_product_id', $product->product_id)->first();
				    
				    if($prodata){
				        $seller_id = $prodata->seller_id;
				    }
				}
				$parametersArray 	=	[
					'access_token'          => $tocken,
				    'order_id'              => $api_order_id,
				    'product_id'            => $product->product_id,
				    'product_name'          => $product->product_name,
				    'product_description'   => $product->product_description,
				    'varients'              => $product->varients,
				    'mrp'                   => $product->mrp,
				    'product_weight'        => $product->product_weight,
				    'quantity'              => $product->quantity,
				    'product_type'          => $product->product_type,
				    'selling_price' 	    => $product->selling_price,
				    'category_id'           => $product->category_id,
				    'order_by'				=> $product->product_type == 'api' ? 0 : 1,
				    'product_link'          => $product->product_type == 'api' ? url('/products/api_product_detail?product_id='.$product->product_id) : url('products/product_detail?product_id='.$product->product_id),
				    'seller_id'             => $seller_id,
				] ;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parametersArray));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec ($ch);
				curl_close ($ch);

				if(!$server_output){
					echo json_encode(array('error' => 1, 'message' => 'check your code there are some problems', 'data' => []));
					exit;
				}
			}

			if(intval($order->apply_coupen_id) != 0  && Auth::user()){
				$assignedCoupon 			=	new AssignedCoupon;
				$assignedCoupon->email    	=	Auth::user()->email;
				$assignedCoupon->coupon_id 	=	$order->apply_coupen_id;
				$assignedCoupon->save();
			}
		}

		$order->saved_to_server = 'yes';
		$order->save();

		$this->data['order']	=	$order;

		if($order->sent_sms == 'no'){
			$mobile_number = $order->customerPhone;
			$sender_name   = "TECHTL";//'KIBAKI';
            //$message       = "Your Transaction has been successful. Your orderid is ".$order->id.". Thank you for your purchase.";
    		//$message 	   = "You techturtle trial verification otp is ".$otp;
    		$orderDays = "10-14 days";
    		$message = "Your order for product(s) with order id ".$order->id." amounting to rs ".$order->orderAmount." is confirmed. It will be delivered by ".$orderDays.". Thanks for shopping.";

    		//$message       = "Your order for "."products"." with Order id ".$order->id." amounting to Rs ".$order->orderAmount." is confirmed. It will be delivered by "."10-14 days"." . Thanks for shopping at kibakibi.";
    		$send_otp      = json_decode($this->sms->sendSms($mobile_number, $message, $sender_name));

    		if(isset($send_otp->status) || $send_otp->status == 'success'){
    			$order->sent_sms = 'yes';
    		}
		}
		
		if($order->sent_sms_to_seller == 'no'){
			$adminUsers    = User::join('trials','trials.user_id','=','users.id')->select('users.id','users.mobile','users.email','trials.subdomain')->where('user_type','admin')->get();
			$name          = 'seller';
			if(!count($adminUsers)){
				goto end;
			}
			
			$mobileArr        = array();
			foreach ($adminUsers as $adminUser) {
			    $name         = $adminUser->subdomain;
				$mobileArr[]  = $adminUser->mobile;
			}

			$mobileNumber     = implode(',', $mobileArr);

			$mobile_number = $mobileNumber;
			$sender_name   = 'TECHTL';
			
			$link          = 'http://admin.techturtle.in';
    		$message       = "Hi ".$name." You have Received an Order your website. Click on the following link to go to your Dashboard ".$link.".";
    		$send_otp      = json_decode($this->sms->sendSms($mobile_number, $message, $sender_name));

    		if(isset($send_otp->status) || $send_otp->status == 'success'){
    			$order->sent_sms_to_seller = 'yes';
    		}

			end: '';
		}

		$order->save();

		return view('front/checkout/message/success', $this->data);
	}

	public function applyCoupon(Request $request){

		if(!$request->ajax()){
			echo 'Invalid request';
			exit;
		}

		if(!isset($request->coupon_code)){
			echo 'invalid parameters';
		}

		if(!Auth::user()){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'You need to login to apply coupon'));
		}

		foreach($request->all() as $key => $value){
			$$key 		 		=	$value;
		}

		if(strlen($coupon_code)<1){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Enter coupon code first'));
		}

		$coupon 				=	Coupon::where('coupon_code', $coupon_code)->first();

		if(!$coupon){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Coupon does not exist'));
		}

		if($coupon->deleted == 'yes' || $coupon->status == 'disabled'){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'This coupon has no longer valid'));
		}

		$currentDate 			=	strtotime(date('d-m-y'));

		$startDate 				=	strtotime(date_format(date_create($coupon->date_start),'d-m-y'));

		$endDate 				=	strtotime(date_format(date_create($coupon->date_end),'d-m-y'));
		//dd($currentDate <= $startDate && $currentDate >= $endDate);
		if($currentDate <= $startDate && $currentDate >= $endDate){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'This coupon has expired'));
		}

		if(AssignedCoupon::where('coupon_id',$coupon->id)->count() >= $coupon->per_coupon_limit ){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Coupon limit finish'));
		}

		if(AssignedCoupon::where('email',Auth::user()->email)->count() >= $coupon->per_user_limit){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'you have already used this coupon'));
		}

		$buynowProducts 		=	BuyNowProducts::where('buy_now_id', $buynowid)->get();

		$totalCartVal 			=	0;
		foreach($buynowProducts as $buynowProduct){
			$totalCartVal       +=  $buynowProduct->product_selling_price;
		}

		if($totalCartVal < $coupon->minimum_order_amt ){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'This coupon required maximum order price <i class="fa fa-inr"></i> '.$coupon->minimum_order_amt));
		}

		$buynow 				=	BuyNow::find($buynowid);

		if(!$buynow){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'invalid buynow id'));
		}

		if($buynow->applied_coupon_code == 'yes'){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'you have already applied a coupon'));
		}

		$discount 				=	0;

		if($coupon->coupon_type == 'fixed_amt'){
			$discount 			=	intval($coupon->discount);
		}else{
			$discount 			=   intval(($totalCartVal*$coupon->discount)/100);
		}

		$buynow->applied_coupon_code 	=	'yes';
		$buynow->free_shipping 			=	$coupon->free_shipping;
		$buynow->coupon_code 			=	$coupon->coupon_code;
		$buynow->discount 				=	$discount;
		$buynow->coupon_code_id 		=	$coupon->id;
		
		if($coupon->free_shipping == 'yes'){
			$buynow->shipping_price 	=	0;
		}

		if(!$buynow->save()){
			return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Try again, coupon does not applied'));
		}

		return Response::json(array('success' => true, 'class' => 'success', 'message' => 'success'));
	}

	public function getFail(Request $request){
		return view('front/checkout/message/fail');
	}

	public function placeReturn(PlaceReturnRequest $request, $orderid){
		$order 			=  Orders::whereIn('status',['delivered'])->where('userId',Auth::user()->email)->where('deleted','no')->find($orderid);

		if(!$order){
			return redirect('/user/orders');
		}

		$order->status = 'return';
		$order->returnComment = $request->reason.'<br/>'.$request->comments;

		$order->save();

		DB::table('return_request')->insertGetId([
                    'oid' => $order->id,
                    'status' => 'open',
                    'comment' => $request->reason.'<br/>'.$request->comments,
                    'recordInsertedDate' => Carbon::now(),
                    ]);
		return redirect('/user/orders');
	}

	public function cancleOrder(PlaceReturnRequest $request, $orderid){
		$order 			=  Orders::whereIn('status',['open'])->where('deleted','no')->where('userId',Auth::user()->email)->find($orderid);

		if(!$order){
			return redirect('/user/orders');
		}

		$order->status = 'cancel';
		$order->returnComment = $request->reason.'<br/>'.$request->comments;

		$order->save();
		return redirect('/user/orders');
	}

}
