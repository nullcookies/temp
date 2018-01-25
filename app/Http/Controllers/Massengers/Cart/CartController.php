<?php

namespace App\Http\Controllers\Massengers\Cart;

use Illuminate\Http\Request;

use App\Http\Requests, Response, Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddCartItemRequest;
use Carbon\Carbon, Session;
use App\Models\Product\Product;
use File, App\Http\Requests\Cart\DeleteCartItemRequest;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Checkout\BuyNow, DB;
use App\Models\Checkout\BuyNowProducts;
use App\Models\Cart\Cart;

class CartController extends Controller{
    
    protected $data = [];
    public function __construct(){}
    
    public function getcartcount(Request $request){
        $cart = [];
    	
    	if(Auth::guest()){
            $user_id = app('request')->session()->getId();
        }else{
            $user_id = Auth::user()->id;
        }

        
		$productimage = [];
		$cart = Cart::join('product','product.id','=','cart.product_id')->leftJoin('product_images','product_images.product_id','=','cart.product_id')->where('product_images.default_image','yes')->where('cart.user_id', $user_id)->select('cart.*','product.product_name','product.product_selling_price','product_images.image')->groupBy('cart.id')->get();
		
		return Response::json(['message' => 'Your required quantity for that product is not available for now','count' => count($cart)],202);exit;
    }

    public function cart(Request $request){
    	$cart = [];
    	
    	if(Auth::guest()){
            $user_id = app('request')->session()->getId();
        }else{
            $user_id = Auth::user()->id;
        }

        
		$productimage = [];
		$cart = Cart::join('product','product.id','=','cart.product_id')->leftJoin('product_images','product_images.product_id','=','cart.product_id')->where('product_images.default_image','yes')->where('cart.user_id', $user_id)->select('cart.*','product.product_name','product.product_selling_price','product_images.image')->groupBy('cart.id')->get();
		
		$subtotal = 0;
		foreach($cart as $cartitem){
			$productImage = url('no_image.png');

			if($cartitem->image && File::exists(public_path().'/product_images/100x100/'.$cartitem->image)){
				$productImage = url('/product_images/100x100/'.$cartitem->image);
			}
			$this->data['productimage'][$cartitem->id] = $productImage;

			$subtotal += ($cartitem->product_selling_price*$cartitem->quantity);

			$shipping_time_arr = explode('_', $cartitem->shipping_time);

    		$this->data['delivery_timing'][$cartitem->id] = $shipping_time_arr[0].':00-'.$shipping_time_arr[1].':00';

    		$this->data['delivering_on'][$cartitem->id]   = Carbon::parse($cartitem->selected_delivery_date)->format('D, d-m');
			
			$this->data['delivery_option'][$cartitem->id] = str_replace('_', ' ', $cartitem->delivery_option);
		}
		$this->data['subtotal'] = $subtotal;

    	$this->data['carts'] = $cart;
    	return view('massengers/cart/cart', $this->data);
    }
    
    public function add_to_cart(AddCartItemRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}
        
        if(Auth::guest()){
            $user_id = app('request')->session()->getId();
        }else{
            $user_id = Auth::user()->id;
        }

    	foreach($request->all() as $key => $value){
    		$$key = $value;
    	}

    	if(!$product = Product::find($productid)){
    		return Response::json(['message' => 'That product no more exist'],421);exit;
    	}

    	if($product->quantity < $quantity){
    		return Response::json(['message' => 'Your required quantity for that product is not available for now'],421);exit;
    	}

    	if(Cart::where('user_id', $user_id)->where('product_id', $productid)->first()){
    		return Response::json(['message' => 'You already has this product in your cart'],421);exit;
    	}

    	$cart = new Cart;
    	$cart->user_id = $user_id;
    	$cart->product_id = $productid;
    	$cart->quantity = $quantity;
    	$cart->selected_delivery_date = $selectedDate;
    	$cart->shipping_time = $delivery_option;
    	$cart->delivery_option = $shippingtime;

    	if(!$cart->save()){
    		return Response::json(['message' => 'An unexpected error occured'],421);exit;
    	}

    	return Response::json(['message' => 'Product successfully added to cart'],202);exit;
    }
    
    //old cart add

    /*public function add_to_cart(AddCartItemRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}

    	if(Auth::user()){
    		goto leftguestsection;
    	}
    	
    	dd(Auth::guest()->id);
    	
    	leftguestsection: '';

    	foreach($request->all() as $key => $value){
    		$$key = $value;
    	}

    	if(!$product = Product::find($productid)){
    		return Response::json(['message' => 'That product no more exist'],421);exit;
    	}

    	if($product->quantity < $quantity){
    		return Response::json(['message' => 'Your required quantity for that product is not available for now'],421);exit;
    	}

    	if(Cart::where('user_id', Auth::user()->id)->where('product_id', $productid)->first()){
    		return Response::json(['message' => 'You already has this product in your cart'],421);exit;
    	}

    	$cart = new Cart;
    	$cart->user_id = Auth::user()->id;
    	$cart->product_id = $productid;
    	$cart->quantity = $quantity;
    	$cart->selected_delivery_date = $selectedDate;
    	$cart->shipping_time = $delivery_option;
    	$cart->delivery_option = $shippingtime;

    	if(!$cart->save()){
    		return Response::json(['message' => 'An unexpected error occured'],421);exit;
    	}

    	return Response::json(['message' => 'Product successfully added to cart'],202);exit;
    }*/

    public function delete_cart_item(DeleteCartItemRequest $request){
    	if(!$request->ajax()){
    		exit;
    	}
        
        if(Auth::guest()){
            $user_id = app('request')->session()->getId();
        }else{
            $user_id = Auth::user()->id;
        }
        
    	if(!$cart = Cart::where('user_id', $user_id)->where('id', $request->cartid)->first()){
    		return Response::json(['message' => 'Cart item already deleted'],421);exit;
    	}

    	if(!$cart->delete()){
    		return Response::json(['message' => 'Unexpected error occured, try again'],421);exit;
    	}

    	return Response::json(['message' => 'Cart Item Successfully deleted'],202);exit;
    }	

    public function checkout_by_cart(Request $request){
    	if(!$request->ajax()){
    		exit;
    	}
    	
    	if(Auth::guest()){
            $user_id = app('request')->session()->getId();
        }else{
            $user_id = Auth::user()->id;
        }

    	$carts = Cart::where('user_id', $user_id)->get();

    	if(!count($carts)){
    		return Response::json(['message' => 'No product in your cart'],421);exit;
    	}

    	$buynow = new BuyNow;
    	foreach($carts as $cart){
    		$productid = $cart->product_id;
    		$quantity  = $cart->quantity;
    		$selectedDate      = $cart->selected_delivery_date;
        	$delivery_option = $cart->shipping_time;
        	$shippingtime = $cart->delivery_option;

        	if(!$product  =  Product::find($productid)){
	            continue;
	        }

	        $productImage        =  DB::table('product_images')->where ('product_id', $product->id)->where ('default_image', 'yes')->select('image')->first();   
	        $productImage        = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 

	        if(! $date = HelperController::validateDate($selectedDate)){
	            continue;
	        }

	        $buynow->selected_delivery_date = $date;
	        $buynow->shipping_time          = $delivery_option;
	        $buynow->delivery_option        = $shippingtime;

	        if(!$buynow->save()){
	            continue;
	        }

	        $buynow_product                 = new BuyNowProducts;
	        $buynow_product->upc            = $product->id;
	        $buynow_product->product_description = $product->product_description;
	        $buynow_product->product_mrp   = $product->product_mrp;
	        $buynow_product->product_selling_price   = $product->product_selling_price;
	        $buynow_product->varients            = 'normal';
	        $buynow_product->product_from        = 'normal';
	        $buynow_product->quantity            = $quantity;
	        $buynow_product->buy_now_id        = $buynow->id;
	        $buynow_product->product_name            = $product->product_name;
	        $buynow_product->weight        = $product->weight;
	        $buynow_product->image        = $productImage;
	        $buynow_product->selected_delivery_date = $date;
	        $buynow_product->shipping_time          = $delivery_option;
	        $buynow_product->delivery_option        = $shippingtime;

	        if(!$buynow_product->save()){
	            BuyNow::where('id',$buynow->id)->delete();
	            continue;
	        }

    	}

    	if(!$buynow->id){
    		return Response::json(['message' => 'Unexpected error occured'],421);
    	}
    	return Response::json(['message' => 'redirecting..','buy_now_id' => $buynow->id],202);
    }
}
