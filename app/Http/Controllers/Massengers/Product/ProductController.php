<?php

namespace App\Http\Controllers\Massengers\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Models\ProductCategory\ProductCategory;
use App\Models\Product\Product,DB, File;

class ProductController extends Controller{
    
    public function __construct(){}

    public function categoryproduct(Request $request, $categoryid){
    	$data = array();
    	$category = Category::where('name_alias',$categoryid)->select('id','category','parentId','name_alias','product_center')->first();

    	if(!$category){
    		echo 'category not exist';
    		exit;
    	}

        $data['banner'] = $category->banner && File::exists(public_path().'/massengers/banners/'.$category->banner->banner) ? url('/massengers/banners/'.$category->banner->banner) : url('/massengers/img/bg-4.jpg');
    	$catid = $category->id;
    	
    	$data['product_center'] =$category->product_center;
    	$_SESSION['catIds']     =   array();
    	$data['category_name']  =   $category->category;
        $data['cat_alias']      =   $category->name_alias;

    	$allCategories          =   self::getAllCategories();
        $childs                 =   self::getChildFromArray($catid, $allCategories);
        $data['categories']     =   $childs;
       
        $allSubCategories       =   self::getFilterCatArr($catid, $allCategories);
        $allProductIds          =   ProductCategory::whereIn('category_id',$allSubCategories)->select('product_id')->groupBy('product_id')->get();
        // get all product id array
        $productArr             =   array();
        foreach($allProductIds as $thisproduct){
            $productArr[]       =   $thisproduct->product_id;
        }

        $paginationArray        = [];

        $max_price = $data['max_price'] =  9999999;
        $min_price = $data['min_price'] =  0;

        $page                     = $data['page']       =  $request->has('page') ? $request->page : 1;
        $data['previousPage']             = ($page<1) ? 1 : $page-1; 
        $data['nextPage']                 = $page+1;

        $products       =   Product::whereIn('product.id',$productArr);

        if($request->has('sort_by')){
        	$paginationArray['sort_by'] = $request->sort_by;

        	if(!in_array($request->sort_by, ['price_asc','price_desc','product_desc'])){
        		goto skippricefilter;
        	}

        	if($request->sort_by == 'price_asc'){
        		$products = $products->orderBy('product.product_selling_price','asc');
        	}
        	if($request->sort_by == 'price_desc'){
        		$products = $products->orderBy('product.product_selling_price','desc');
        	}
        	if($request->sort_by == 'product_desc'){
        		$products = $products->orderBy('product.id','desc');
        	}
        }

        if($request->has('pricefilter') && count(explode('_', $request->pricefilter)) == 2){

            $pricefilter = explode('_', $request->pricefilter);
            $paginationArray['pricefilter'] = $pricefilter;
            if(intval($pricefilter[0])>0){
                $min_price = intval($pricefilter[0]);
            }

            if(intval($pricefilter[1])>intval($pricefilter[0])){
                $max_price = intval($pricefilter[1]);
            }         
            $products = $products->where('product.product_selling_price','>=',$min_price)->where('product.product_selling_price','<=',$max_price);   
        }

        $data['pricefilter'] = $min_price.'_'.$max_price;

        skippricefilter: '';

        if($request->has('price')){
        	$paginationArray['price'] = $request->price;

        	if(!is_numeric($request->price)){
        		goto skipsortfilter;
        	}

        	$products = $products->where('product.product_selling_price','<=',$request->price);
        }

        skipsortfilter: '';

        $data['products'] = $products->select('product.id','product.product_name','product_selling_price','product_mrp','product_description')->where('deleted','no')->paginate(20)->appends($paginationArray);
        
        $_SESSION['parentId'][] =   array('id' => $category->id, 'category_name' => $category->category,'alias' => $category->name_alias);
        $breadCrumbCategories   =  self::getAllParentArr($catid, $allCategories);
        $data['breadCrumbCategories'] = array_reverse($breadCrumbCategories);
        // code for fetching product image
        $data['productImage']   = array();
        foreach($data['products'] as $product){
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            $data['productImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }

    	return view('massengers/product/categoryproduct/categoryproduct', $data);
    }

    public function getAllCategories(){
        $categories         =   Category::select('id','category','parentId','flag','name_alias')->get();
        if(!$categories){
            echo 'category not exist';
            exit;
        }
        $carArr         =   array();
        foreach($categories as $category){
            $carArr[]   =   array('id' => $category->id, 'category' => $category->category, 'falg' => $category->flag, 'parentId' => $category->parentId,'alias' => $category->name_alias);
        }

        return $carArr;     
    }

    function getFilterCatArr($catid, $categories){  // give all child and their chind and their child (and so on )in an single array
        $_SESSION['catIds'][]  = $catid;
        foreach($categories as $category){
            if($category['parentId'] == $catid){
                self::getFilterCatArr($category['id'], $categories);
            }
        }
        return $_SESSION['catIds'];
    }

    public function getChildFromArray($category_id, $allCategories){
        $childs         =   array();
        foreach($allCategories as $key => $category){
            if($category['parentId'] != $category_id){
                continue;
            }

            $childs[]               =   $category;
            $childs[count($childs)-1]['child']     =   self::getChildFromArray($category['id'], $allCategories);
        }

        return $childs;
    }

    public function getAllParentArr($catid, $categories){
        $parentId       =   0;
        $category_name  =   '';
        
        foreach($categories as $category){
            if($category['id'] == $catid){
                $parentId       =   $category['parentId'];
            }
        }

        foreach($categories as $category){
            if($category['id'] == $parentId){
                $category_name  =   $category['category'];
            }
        }

        foreach($categories as $category){
            if($category['id'] == $parentId){
                $alias  =   $category['alias'];
            }
        }

        foreach($categories as $category ){

            if($parentId == 0){
                continue;
            }

            $session            =   array();
            foreach($_SESSION['parentId'] as $session){
                $parentids[]      =   $session['id'];
            }

            if(in_array($parentId, $parentids)){
                break;
            }

            $_SESSION['parentId'][]      =  array('id' => $parentId,'category_name' => $category_name, 'alias' => $alias);
            self::getAllParentArr($parentId, $categories);
        }

        return $_SESSION['parentId'];
    }
    
    public static function getVarientPrice($productid,$varientid, $productprice){
        $price = 0;

        $varientPrice = DB::table('product_varient_price')->where('product_id', $productid)->where('varients', $varientid)->first();

        if($varientPrice){
            $price = $varientPrice->price;
        }

        if(!$price){
            $price = $productprice;
        }

        return $price;
    }
}
