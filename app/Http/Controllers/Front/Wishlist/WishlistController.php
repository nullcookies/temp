<?php

namespace App\Http\Controllers\Front\Wishlist;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Wishlist\Wishlist;
use Auth;
use App\Models\ProductImage\ProductImage;
use File, Session;

class WishlistController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data 			=	array();
    }

    public function addWishlistAjax(Request $request){

    	if(!$request->ajax()){
    		echo 'bad request';
    	}

    	if(!\Auth::user()){
    		return \Response::json(array('fail' => true, 'message' => 'Login is required before adding to Wishlist'));
    	}

    	$check 				=	Wishlist::where('product_id',$request->productid)->where('user_id',Auth::user()->id)->first();

    	if($check){
    		return \Response::json(array('fail' => true, 'message' => 'This Product is already in your wishlist'));
    	}

    	$wishlist 				=	new Wishlist;
    	$wishlist->user_id  	=   \Auth::user()->id;
    	$wishlist->product_id	=	$request->productid;

    	if(!$wishlist->save()){
    		return \Response::json(array('fail' => true, 'message' => 'Some Error Occured, Try Again'));
    	}

    	return \Response::json(array('success' => true, 'message' => 'Product successfully added to Wishlist'));
    }

    public function showWishlist(Request $request){

    	$data 					=	$this->data;
    	$data['wishlists'] 				=	Wishlist::join('product','product.id','=','wishlist.product_id')
    	->select('wishlist.id','product.id as product_id','product.product_name','product.product_mrp','product.product_selling_price')
    	->where('user_id', Auth::user()->id)
        ->get();

        foreach($data['wishlists'] as $wishlist){
            $product_image                     =   ProductImage::where('default_image','yes')->where('product_id',$wishlist->product_id)->first();
            $data['image'][$wishlist->id]      =   ($product_image && File::exists(public_path('product_images/100x100/'.$product_image->image))) ? asset('product_images/100x100/'.$product_image->image) : url('no_image.png');
        }

    	//dd($wishlists);
    	return view('front/wishlist/wishlist',$data);
    }

    public function deleteWishlistItem(Request $request){

        if(!Auth::user()){
            return redirect('/wishlist');
        }

        $wishlistItem   =  Wishlist::find($request->wishlist_id);

        if(!$wishlistItem){
            Session::flash('error','Some thing happen wrong, try again..');
            return redirect('/wishlist');
        }

        if($wishlistItem->delete()){
            Session::flash('success','Item Successfully deleted from wishlist');
            return redirect('/wishlist');
        }

    }
}
