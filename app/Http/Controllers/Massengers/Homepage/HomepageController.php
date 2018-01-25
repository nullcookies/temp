<?php

namespace App\Http\Controllers\Massengers\Homepage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Massengers\Product\ProductController, DB, Response;
use App\Models\ProductCategory\ProductCategory;
use App\Models\Product\Product;

class HomepageController extends Controller{
    
    protected $data = [];
    public function __construct(){
    }

    public function homepage(Request $request){

    	$productHlper = new ProductController;
    	$allCategories = $productHlper->getAllCategories();
    	$cakes = $productHlper->getFilterCatArr(1,$allCategories);
    	$all_flowers = $productHlper->getFilterCatArr(1,$allCategories);
    	$chocholates = $productHlper->getFilterCatArr(1,$allCategories);
    	$cards = $productHlper->getFilterCatArr(1,$allCategories);
        
        // bday product section
        $categoryids = array_merge($all_flowers,$cakes,$chocholates,$cards);
    	$allProductIds          =   ProductCategory::whereIn('category_id',$categoryids)->select('product_id')->groupBy('product_id')->get();

    	$productArr             =   array();
        foreach($allProductIds as $thisproduct){
            $productArr[]       =   $thisproduct->product_id;
        }

        $paginationArray        = [];

        $products     = $data['products']  =   Product::join('product_category','product_category.category_id','=','product.id')->whereIn('product.id',$productArr)->select('product.*','product_category.category_id')->orderBy('id','desc')->limit(10)->get();
        $data['productImage']   = array();
        foreach($products as $product){
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    
            $data['productCat'][$product->id] = DB::table('category')->where('id', $product->category_id)->first()->name_alias;
            $data['productImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }
        
        // valentine day product
        
        $categoryids = array_merge($chocholates,$cards);
    	$allProductIds          =   ProductCategory::whereIn('category_id',$categoryids)->select('product_id')->groupBy('product_id')->get();

    	$productArr             =   array();
        foreach($allProductIds as $thisproduct){
            $productArr[]       =   $thisproduct->product_id;
        }

        $paginationArray        = [];

        $products     = $data['valentineproducts']  =   Product::join('product_category','product_category.category_id','=','product.id')->whereIn('product.id',$productArr)->select('product.*','product_category.category_id')->orderBy('id','desc')->limit(10)->get();
        $data['valentineproductImage']   = array();
        foreach($products as $product){
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    
            $data['valentineProductCat'][$product->id] = DB::table('category')->where('id', $product->category_id)->first()->name_alias;
            $data['valentineproductImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }
        
    	return view('massengers/homepage/homepage', $data);
    }


}
