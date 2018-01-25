<?php

namespace App\Http\Controllers\Front\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller, Response;
use App\Models\Varient\SelectedVarient, Redirect;
use App\Traits\CommissionType;
use App\Models\Product\Product;
use App\Models\Cart\Cart, Auth;
use App\Models\Cart\CartVarient;
use App\Models\Api\ApiProduct;
use DB;
use App\Models\Checkout\BuyNow;
use App\Models\Checkout\BuyNowProducts;
use App\Models\Categories_commission\Categories_commission;
use App\Models\CommossionType\StandardCommission;

class CartController extends Controller{
    
    use CommissionType;
	public $data;
	public function __construct(){
		$this->data  = array();
	}
    
    public function addToCartAjax(Request $request){

    	if(!$request->ajax()){
    		return Response::json(array(['fail' => 'true', 'message' => 'Invalid Request']));
    		exit;
    	}

    	if(!Auth::user()){
    		return Response::json(array(['fail' => 'true', 'message' => 'You must logged in']));
    		exit;
    	}

		if(!$request->has('product_id')){
			return Response::json(['fail' => 'true', 'message' => 'Product id is manditory failed']);
			exit;
		}

        if(!$request->has('product_from')){
            return Response::json(['fail' => 'true', 'message' => 'Invalid parameters']);
            exit;
        }

        $productType    =   $request->product_from;

		$product_id 	=	$request->product_id;

		if(!$request->has('qty')){
			return Response::json(['fail' => 'true', 'message' => 'Quantity must be greater that 0']);
			exit;
		}

		$quantity       = $request->qty;

		if($quantity<1){
			return Response::json(['fail' => 'true', 'message' => 'Quantity must be greater that 0']);
			exit;
		}

		$productVarients        =  SelectedVarient::join('varient_types','varient_types.id','=','selected_varient_for_product.varient_type_id')->where('product_id',$product_id)->groupBy('varient_type_id')->select('varient_types.varient_type','varient_types.id')->get();

		$terminate 			=	false;
		$varientValues      =   array();

		if($productVarients){

			foreach($productVarients as $productVarient){
				$varientName = ($productVarient->varient_type);
				$varientValues[] = array('varient_type' => $request->$varientName, 'varient_id' => $productVarient->id);
				if(!isset($request->$varientName)){ // || $request->$varientName != $productVarient->id
					$terminate  =   true;
				}	
			}
		}

		
		if($terminate){
			return Response::json(['fail' => 'true', 'message' => 'Select Varients']);
			exit;
		}

		$find 				=	Cart::where('user_id', Auth::user()->id)->where('product_id',$product_id)->first();

		if($find){
			return Response::json(['fail' => 'true', 'message' => 'Product Already in your cart']);
			exit;
		}

		$cart 				=	new Cart;
		$cart->user_id  	=   Auth::user()->id;
		$cart->product_id 	= 	$product_id;
		$cart->quantity		=	$quantity;
        $cart->product_type =   $productType;
		if($cart->save()){

			foreach($varientValues as $varientValue){
				DB::table('cart_varients')->insert(array('cart_id' => $cart->id, 'varient_type_id' => $varientValue['varient_id'], 'varient_type_value_id' => $varientValue['varient_type']));
			}
		}

		return Response::json(array('success' => true, 'message' => 'Product Successfully added to cart'));
    }

    public function fetchCartAjax(Request $request){

    	if(!$request->ajax()){
    		return Response::json(array(['fail' => 'true', 'message' => 'Invalid Request']));
    		exit;
    	}

    	if(!Auth::user()){
    		echo '<li class="item first"><div class="item-inner">You must Logged In</div></li>';
    		exit;
    	}

    	$data   				=	$this->data;
    	$data['cartItems'] 		=	Cart::where('user_id', Auth::user()->id)->get();
        $commissionType = self::commissionType();
        $productPrice           =   0;
        $commission_perc        = 0;
    	foreach($data['cartItems'] as $cartItem){
            $data['cartProducts']   =   array();

            if($cartItem->product_type == 'api'){
                $data['cartProduct'][$cartItem->id]   =   ApiProduct::where('api_product_id', $cartItem->product_id)->select('api_product_id as id','productTitle as product_name','description as product_description','sellingPrice as product_selling_price','mrp as product_mrp','product_images','categoryId','expected_payout')->first();
            }else{
                $data['cartProduct'][$cartItem->id]   =   Product::where('id', $cartItem->product_id)->select('id','product_name','product_description','product_selling_price','product_mrp')->first();
            }
            
            $product = $data['cartProduct'][$cartItem->id];

            $productPrice      = $cartItem->product_selling_price;
            if($cartItem->product_type == 'api'){
                if(in_array($commissionType, ['standard_commission','category_commission'])){
                    if($commissionType == 'category_commission'){
                        $catComm = Categories_commission::where('category_id',$product->categoryId)->first();
                        $commission_perc = $catComm ? $catComm->price : $commission_perc;
                    }else{
                        $standComm = StandardCommission::where('min','<',$product->expected_payout)->where('max','>',$product->expected_payout)->first();
                        $commission_perc = $standComm ? $standComm->commission : $commission_perc;
                    }
                }
                $productPrice   = intval(($product->expected_payout * (100 +$commission_perc))/100);
            }

            $data['productDetailPage'][$cartItem->id]   =  $cartItem->product_type == 'api' ? 'api_product_detail': 'product_detail' ;

    		$productImage        =  DB::table('product_images')
            ->where ('product_id', $cartItem->product_id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            if($cartItem->product_type == 'api'){
                $data['productImage'][$cartItem->id] =  explode(',',$data['cartProduct'][$cartItem->id]->product_images)[0];
            }else{
                $data['productImage'][$cartItem->id] = ($productImage && \File::exists(public_path('/product_images/100x100/'.$productImage->image))) ? url('/product_images/100x100/'.$productImage->image) : url('no_image.png'); 
            }
            
    		$data['sellingPrice'][$cartItem->id] = $productPrice ;//$cartItem->product_selling_price;
    	}

    	return view('front/cart/header/ajax/ajaxCart', $data);
    }

    public function removeCartAjax(Request $request){
    	if(!$request->ajax()){
    		return Response::json(array(['fail' => 'true', 'message' => 'Invalid Request']));
    		exit;
    	}

    	if(!Auth::user()){
    		return Response::json(array(['fail' => 'true', 'message' => 'You must logged in']));
    		exit;
    	}

    	if(!$request->has('cartid')){
    		return Response::json(array(['fail' => 'true', 'message' => 'Invalid Parameters']));
    		exit;
    	}

    	$cartid   = $request->cartid;

    	$cart     = Cart::find($cartid);

    	if(!$cart){
    		return Response::json(array(['fail' => 'true', 'message' => 'Invalid cartid']));
    		exit;
    	}

    	if(!$cart->delete()){
    		return Response::json(array(['fail' => 'true', 'message' => 'Some Error Occured, Try Again']));
    		exit;
    	}

    	return Response::json(array(['success' => 'true', 'message' => 'Successfully Deleted !']));
    }

    public function cart(Request $request){

        $data           =   $this->data;

        if(!Auth::user()){
            return redirect('/login');
        }

        $data['cartItems']      =   Cart::where('user_id', Auth::user()->id)->get();
        
        $productPrice   =   0;
        foreach($data['cartItems'] as $cartItem){

            $data['cartProducts']   =   array();

            if($cartItem->product_type == 'api'){
                $data['cartProduct'][$cartItem->id]   =   ApiProduct::where('api_product_id', $cartItem->product_id)->select('api_product_id as id','productTitle as product_name','description as product_description','sellingPrice as product_selling_price','mrp as product_mrp','product_images')->first();
            }else{
                $data['cartProduct'][$cartItem->id]   =   Product::where('id', $cartItem->product_id)->select('id','product_name','product_description','product_selling_price','product_mrp')->first();
            }

            $data['productDetailPage'][$cartItem->id]   =  $cartItem->product_type == 'api' ? 'api_product_detail': 'product_detail' ;
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $cartItem->product_id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first(); 

            $productPrice += $cartItem->quantity * $data['cartProduct'][$cartItem->id]->product_selling_price;
            if($cartItem->product_type == 'api'){
                $data['productImage'][$cartItem->id] =  explode(',',$data['cartProduct'][$cartItem->id]->product_images)[0];
            }else{
                $data['productImage'][$cartItem->id] = ($productImage && \File::exists(public_path('/product_images/100x100/'.$productImage->image))) ? url('/product_images/100x100/'.$productImage->image) : url('no_image.png'); 
            }
            
            $cartVarients   =   CartVarient::join('varient_type_values','varient_type_values.id','=','cart_varients.varient_type_value_id')
            ->where('cart_id', $cartItem->id)
            ->select('varient_type_values.value')
            ->get();

            $varients  = '';

            foreach($cartVarients as $cartVarient){
                $varients .= $cartVarient->value.',';
            }

            $data['cartVarient'][$cartItem->id] = $varients;
        }

        $data['productPrice'] = $productPrice;
        return view('front/cart/cart', $data);
    }

    public function destroy($cartid){

        $cartItem           =   Cart::where('id',$cartid)->where('user_id',Auth::user()->id)->first();
        if(!$cartItem){
            return Redirect::back();
        }

        $cartItem->delete();
        return Redirect::back();
    }

    public function updateQty($cartid, Request $request){
        if(!$request->qty || strlen($request->qty) < 1 || !is_numeric($request->qty) || $request->qty < 1 ){
            return redirect('/cart');
        }

        $cartItem           =   Cart::where('id',$cartid)->where('user_id',Auth::user()->id)->first();
        if(!$cartItem){
            return redirect('/cart');
        }

        $cartItem->quantity =   $request->qty;

        $cartItem->save();

        return redirect('/cart');
    }

    public function proceedToCartCaheckout(Request $request){
        $data           =   $this->data;

        if(!Auth::user()){
            return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Login First.'));
            exit;
        }

        $buynow                 =   new BuyNow;

        if(!$buynow->save()){
            return Response::json(array('fail' => true, 'class' => 'danger', 'message' => 'Try Again.'));
            exit;
        }

        $data['cartItems']      =   Cart::where('user_id', Auth::user()->id)->get();
        $commissionType = self::commissionType();
        
        $productPrice           =   0;
        $commission_perc        = 0;
        foreach($data['cartItems'] as $cartItem){

            $product            =   array();

            if($cartItem->product_type == 'api'){
                $product        =   ApiProduct::where('api_product_id', $cartItem->product_id)->select('api_product_id as id','productTitle as product_name','description as product_description','sellingPrice as product_selling_price','mrp as product_mrp','product_images','expected_payout','categoryId')->first();
            }else{
                $product        =   Product::where('id', $cartItem->product_id)->select('id','product_name','product_description','product_selling_price','product_mrp')->first();
            }
            
            $cartVarients   =   CartVarient::join('varient_type_values','varient_type_values.id','=','cart_varients.varient_type_value_id')
            ->where('cart_id', $cartItem->id)
            ->select('varient_type_values.value')
            ->get();

            $varients  = '';

            foreach($cartVarients as $cartVarient){
                $varients .= $cartVarient->value.',';
            }
            
            $productPrice = $product->product_selling_price;
            if($cartItem->product_type == 'api'){

                if(in_array($commissionType, ['standard_commission','category_commission'])){
                    if($commissionType == 'category_commission'){
                        $catComm = Categories_commission::where('category_id',$product->categoryId)->first();
                        $commission_perc = $catComm ? $catComm->price : $commission_perc;
                    }else{
                        $standComm = StandardCommission::where('min','<',$product->expected_payout)->where('max','>',$product->expected_payout)->first();
                        $commission_perc = $standComm ? $standComm->commission : $commission_perc;
                    }
                }

                $productPrice   = intval(($product->expected_payout * (100 +$commission_perc))/100);
            }

            $cartProduct                        =   new BuyNowProducts;
            $cartProduct->upc                   =   $product->id;
            $cartProduct->product_name          =   $product->product_name;
            $cartProduct->product_description   =   $product->product_description;
            $cartProduct->product_mrp           =   $product->product_mrp;
            $cartProduct->product_selling_price =   $productPrice;//$product->product_selling_price;
            $cartProduct->varients              =   $varients;
            $cartProduct->product_from          =   $cartItem->product_type;
            $cartProduct->quantity              =   $cartItem->quantity;
            $cartProduct->buy_now_id            =   $buynow->id;

            $cartProduct->save();
        }

        $cartIds                                =   array();
        foreach($data['cartItems'] as $cartItem){
            $cartIds[]                          =   $cartItem->id;
        }

        DB::table('cart')->whereIn('id',$cartIds)->delete();
        return Response::json(array('success' => true, 'class' => 'success', 'message' => 'successfull', 'buynowid' => base64_encode($buynow->id)));
        exit;
    }
}
