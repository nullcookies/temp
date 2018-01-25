<?php

namespace App\Http\Controllers\Massengers\ProductSearch;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use DB, Redirect;

class ProductSearchController extends Controller{
   
    public function search(Request $request){

    	if(!$request->has('q')){
    		return Redirect::back();
    	}

    	$data = array();
    	
    	$data['searchstr'] = $request->q;

        $paginationArray        = [];

        $products       =   Product::where('product.product_name','like','%'.$request->q.'%')->orWhere('product.sku','like','%'.$request->q.'%');

        if($request->has('q')){
        	$paginationArray['q'] = $request->q;

        }

        skippricefilter: '';

        if($request->has('price')){
        	$paginationArray['price'] = $request->price;

        	if(!is_numeric($request->price)){
        		goto skipsortfilter;
        	}

        	$products = $products->where('product.product_selling_price','<=',$request->price);
        }

        skipsortfilter: '';

        $data['products'] = $products->select('product.id','product.product_name','product_selling_price','product_mrp','product_description')->where('deleted','no')->paginate(25)->appends($paginationArray);

        // code for fetching product image
        $data['cat_alias']      = 'nope';
        $data['productImage']   = array();
        foreach($data['products'] as $product){
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            $data['cat_alias']  = DB::table('product_category')->join('category','category.id','=','product_category.category_id')->whereIn('product_category.product_id',[$product->id] )->select('name_alias')->first();

            $data['productImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }

    	return view('massengers/product/search/search', $data);
    }


}
