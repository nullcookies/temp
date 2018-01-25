<?php

namespace App\Http\Controllers\Front\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller, DB;
use App\Http\Controllers\Admin\Product\ProductController as AdminProduct;
use App\Http\Requests\Product\ProductDetailRequest;
use App\Models\Product\Product, Auth, Session;
use App\Models\Api\ApiProduct;
use App\Category;
use App\Models\CommossionType\CommissionType;
use App\Models\Categories_commission\Categories_commission;
use App\Models\CommossionType\StandardCommission;

class ProductController extends Controller{
    
	public $data;

	public function __construct(){

		$this->data 		=	array();
	}

    public function showProducts(Request $request){

    	$data 			 	=	$this->data;

    	if(!isset($request->catid)){
    		return redirect('/404');
    	}

    	$catid 			=	$request->catid;
    	$category       =	DB::table('category')->where('id', $catid)->where('deleted','no')->first();

    	if(!$category){
    		return redirect('/404');
    	}

        $_SESSION['catIds']     =   array();

        $data['category_name']  =   $category->category;
        $data['category_id']    =   $category->id;

        $data['price_filter']   = $pricerange =  isset($request->price) && !is_null($request->price) && strlen($request->price)? $request->price : 0;

    	//$data['categories'] 	=	self::getAllChild($catid); //uncomment to enable old child module

        $pricerange =   $pricerange && count(explode('_',$pricerange)) <3 ? $pricerange : null;
        $minprice   =   isset($pricerange) && intval(explode('_',$pricerange)[0]) ? intval(explode('_',$pricerange)[0]) : 0;
        $maxprice   =   isset($pricerange) && isset(explode('_',$pricerange)[1]) ? intval(explode('_',$pricerange)[1]) : 999999 ;

        $allCategories          =   self::getAllCategories();
        $childs                 =   self::getChildFromArray($catid, $allCategories);

        $data['categories']     =   $childs;

        //dd($data['categories']);
        //$allSubCategories       =   self::getFilterCat($catid); // uncomment to enable old module


        $allSubCategories       =   self::getFilterCatArr($catid, $allCategories);
        $allProductIds          =   DB::table('product_category')->whereIn('category_id',$allSubCategories)->select('product_id')->groupBy('product_id')->get();

        $productArr             =   array();
        foreach($allProductIds as $thisproduct){
            $productArr[]       =   $thisproduct->product_id;
        }
        $products               =   DB::table('product');

        $data['products']       =   $products->whereIn('product.id',$productArr)->where('product_selling_price','>=',$minprice)->where('product_selling_price','<=',$maxprice)->select('product.id','product.product_name','product_selling_price','product_mrp','product_description')->where('deleted','no')->paginate(9);

        $_SESSION['parentId'][] =   array('id' => $category->id, 'category_name' => $category->category);
        //$data['breadCrumbCategories']   =  self::getAllParent($catid);  //uncomment to enable old breadcrumb parents module
        
        $breadCrumbCategories   =  self::getAllParentArr($catid, $allCategories);
        $data['breadCrumbCategories'] = array_reverse($breadCrumbCategories);

//dd($data['breadCrumbCategories']);
        //sort($data['breadCrumbCategories']);

        $data['viewType']       =   isset($_GET['viewType']) ? $_GET['viewType'] : '';

        $normalProductIds       = array();
        $data['productImage']   = array();
        foreach($data['products'] as $product){
            $normalProductIds[]   = $product->id;
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            $data['productImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }

        //$data['filterVarients']          =  self::getCategoryProductFilters($category->id)['varient_types'];

        $data['filterVarients'] = array();
        $data['varientTypeValues']       =  array();
        foreach($data['filterVarients'] as $filterVarient){

            $productsOfCat               =  self::getCategoryProductFilters($category->id)['product_ids'];
            $data['varientTypeValues'][$filterVarient->varient_type_id]   =  DB::table('selected_varient_for_product')
            ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
            ->whereIn('selected_varient_for_product.product_id',$productsOfCat)->where('selected_varient_for_product.varient_type_id',$filterVarient->varient_type_id)->groupBy('selected_varient_for_product.varient_type_value_id')->select('varient_type_values.id','varient_type_values.value')->get();
        }
        $page                     = $data['page']       =  $request->has('page') ? $request->page : 1;
        $data['previousPage']             = ($page<1) ? 1 : $page-1; 
        $data['nextPage']                 = $page+1;
        
        
        $commissionType           =  CommissionType::where('is_selected','yes')->first();
        $data['commissionType']      =  '';
        if($commissionType){
            $data['commissionType']  =  $commissionType->commission_type;
        }
        
        /* api products */
        $data['apiresults']          =  self::getApiMultipleCatProducts($catid, $page, $pricerange);
        
        $data['product_price']       = array();

        //dd($data['apiresults']);
        $apiProductIds                      =   array();
        if($data['apiresults']){
            $dataArray                          =   array();
            foreach($data['apiresults']  as $key => $value){
                
                /* new code */
                $commission_perc        = 0;
                if(in_array($data['commissionType'], ['standard_commission','category_commission'])){
                    if($data['commissionType'] == 'category_commission'){
                        $catComm = Categories_commission::where('category_id',$value['categoryId'])->first();
                        $commission_perc = $catComm ? $catComm->price : $commission_perc;
                    }else{
                        $standComm = StandardCommission::where('min','<',$value['expected_payout'])->where('max','>',$value['expected_payout'])->first();
                        $commission_perc = $standComm ? $standComm->commission : $commission_perc;
                    }
                }

                $data['product_price'][$value['id']] = intval($value['expected_payout']+($value['expected_payout'] * $commission_perc/100));
                $data['product_mrp_price'][$value['id']] = $value['mrp'];
                /* new code */
                $apiProductIds[$key]                =  $value['id'];
                $dataArray[$key]                    =   [
                    'api_product_id'                =>  $value['id'],
                    'imageUrl'                      =>  $value['imageUrl'],
                    'productTitle'                  =>  $value['productTitle'],
                    'categoryId'                    => $value['categoryId'],
                    'mrp'                           => $value['mrp'],
                    'retailPrice'                   => $value['retailPrice'],
                    'sellingPrice'                  => $value['sellingPrice'],
                    'transfer_price'                => $value['transfer_price'],
                    'margin'                        => $value['margin'],
                    'final_visible_price'           => $value['final_visible_price'],
                    'final_paid_price'              => $value['final_paid_price'],
                    'description'                   => $value['description'],
                    'committedQuantity'             => $value['committedQuantity'],
                    'cod'                           => $value['cod'],
                    'weight'                        => $value['weight'],
                    'freeShipping'                  => $value['freeShipping'],
                    'product_images'                => $value['productPhoto'],
                    'varients'                      => $value['varient'],
                    'expected_payout'               => $value['expected_payout'],
                    'seller_id'                     => $value['recordInsertedBy'],
                ];
                
                $data['product_img'][$value['id']]   =   explode(',', $value['productPhoto'])[0];
            }

            $searchRecords            =   ApiProduct::whereIn('api_product_id', $apiProductIds)->get();

            $existingRecordsid        = array();
            foreach($searchRecords as $searchRecord){
                $existingRecordsid[]    =   $searchRecord->api_product_id;
            }

            $notexistingArrayid         =   array_diff($apiProductIds, $existingRecordsid);

            $updateRecordArr            =   array();
            $insertRecordArr            =   array();
            foreach($dataArray as $recordArr){

                foreach($existingRecordsid as $existingid){
                    if($recordArr['api_product_id'] == $existingid){
                        $updateRecordArr[]   = $recordArr;
                        continue;
                    }
                }

                foreach($notexistingArrayid as $notexistingid){
                    if($recordArr['api_product_id'] == $notexistingid){
                        $insertRecordArr[]   = $recordArr;
                        continue;
                    }
                }
            }

            //$updateQue  = ApiProduct::whereIn('api_product_id', $existingRecordsid)->update($updateRecordArr);
            $insertQue  = ApiProduct::insert($insertRecordArr);
        }

        return view('front/products/showProducts', $data);
    }

    /* New filter cat module */
    function getFilterCatArr($catid, $categories){  // give all child and their chind and their child (and so on )in an single array
        $_SESSION['catIds'][]  = $catid;
        foreach($categories as $category){
            if($category['parentId'] == $catid){
                self::getFilterCatArr($category['id'], $categories);
            }
        }
        return $_SESSION['catIds'];
    }

    /* new filter cat module */

    function getFilterCat($catid){  // give all child and their chind and their child (and so on )in an single array
        
        $categories     =   DB::table('category')->where('parentId',$catid)->get();
        $_SESSION['catIds'][]  = $catid;
        foreach($categories as $category){
            self::getFilterCat($category->id);
        }
        return $_SESSION['catIds'];
    }

    /* new fetch category childs module methods start */
    public function getAllCategories(){
        $categories         =   Category::select('id','category','parentId','flag')->get();
        if(!$categories){
            echo 'category not exist';
            exit;
        }
        $carArr         =   array();
        foreach($categories as $category){
            $carArr[]   =   array('id' => $category->id, 'category' => $category->category, 'falg' => $category->flag, 'parentId' => $category->parentId);
        }

        return $carArr;     
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
    /* new fetch category childs module methods ends */

    public function getAllChild($catid){

    	$childs 		=	array();
    	$myallCat		=	array();
    	$categories 	=	DB::table('category')->where('parentId',$catid)->select('id','category','parentId','flag')->get();
  
    	foreach($categories as $key => $category){
    		$childs[$key]['id']			=	$category->id;
    		$childs[$key]['category']	=	$category->category;
            $childs[$key]['flag']       =   $category->flag;
    		$childs[$key]['child']		=	self::getAllChild($category->id);
    	}

    	return $childs;
    }

    /* new get all parents module start */

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

            $_SESSION['parentId'][]      =  array('id' => $parentId,'category_name' => $category_name);
            self::getAllParentArr($parentId, $categories);
        }

        return $_SESSION['parentId'];
    }

    /* new get all parents module ends */

    public function getAllParent($catid){

        $categories      =   DB::table('category')->where('id',$catid)->where('parentId','!=',0)->get();

        foreach($categories as $category ){
            $_SESSION['parentId'][]      =  array('id' => $category->parentId,'category_name' => DB::table('category')->where('id',$category->parentId)->select('category')->first()->category);
            self::getAllParent($category->parentId);
        }

        return $_SESSION['parentId'];
    }

    public function getCategoryProductFilters($catid){

        $products           =   DB::table('product_category')
        ->join('product','product.id','=','product_category.product_id')
        ->where('product.deleted','no')
        ->where('product_category.category_id', $catid)->select('product_category.product_id')->get();

        $productArr         =   array();

        foreach($products as $product){

            $productArr[]   =  $product->product_id;
        }

        $varientTypes       =   DB::table('selected_varient_for_product')
        ->join('varient_types','varient_types.id','=','selected_varient_for_product.varient_type_id')
        ->whereIn('selected_varient_for_product.product_id',$productArr)
        ->groupBy('selected_varient_for_product.varient_type_id')
        ->select('selected_varient_for_product.varient_type_id','varient_types.varient_type')
        ->get();
        
        return array('varient_types' => $varientTypes, 'product_ids' => $productArr);
    }

    public function product_detail(ProductDetailRequest $request){

        $data                =   $this->data;
        $product             =   Product::find($request->product_id);
        
        if(!$product){
            return \Redirect::back();
        }

        $data['product']     =  $product;

        $productImage        =  DB::table('product_images')->where('product_id', $product->id)->select('id','image','default_image');
        $data['defaultImage']=  url('no_image.png') ;

        $data['productImages']  =   $productImage->get();

        foreach($data['productImages'] as $image){
            $data['image'][$image->id] = (\File::exists(public_path('product_images/'.$image->image))) ? asset('product_images/'.$image->image) : url('no_image.png') ;
            $data['imageSmall'][$image->id] = (\File::exists(public_path('product_images/100x100/'.$image->image))) ? asset('product_images/100x100/'.$image->image) : url('no_image.png') ;
            
            if($image->default_image == 'yes'){
                $data['defaultImage']  =  $data['image'][$image->id];  
            }
        }

        $data['varientTypes']       =   DB::table('selected_varient_for_product')
        ->join('varient_types','varient_types.id','=','selected_varient_for_product.varient_type_id')
        ->where('selected_varient_for_product.product_id',$request->product_id)
        ->groupBy('selected_varient_for_product.varient_type_id')
        ->select('selected_varient_for_product.varient_type_id','varient_types.varient_type')
        ->get();
        
        foreach($data['varientTypes'] as $filterVarient){

            $data['varientValues'][$filterVarient->varient_type_id] = DB::table('selected_varient_for_product')
            ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
            ->where('selected_varient_for_product.product_id',$request->product_id)->where('selected_varient_for_product.varient_type_id',$filterVarient->varient_type_id)->groupBy('selected_varient_for_product.varient_type_value_id')->select('varient_type_values.id','varient_type_values.value')->get();
        }

        $data['stockStatus'] =  ($product->quantity > 0) ? 'In Stock' : 'Not in Stock' ;
        
        $data['description'] = isset($apiProductName['desc']) ? str_replace(array("ssttddppeeff"),"\r\t",$apiProductName['desc']) : $product->description;
        
        return view('front/products/product_detail/product_detail', $data);
    }

    public function getApiMultipleCatProducts($categoryid = null, $page = null, $pricerange = null){
        $pricerange =   $pricerange && count(explode('_',$pricerange)) <3 ? $pricerange : null;
        $minprice   =   isset($pricerange) && intval(explode('_',$pricerange)[0]) ? '/'.intval(explode('_',$pricerange)[0]) : '/0';
        $maxprice   =   isset($pricerange) && isset(explode('_',$pricerange)[1]) ? '/'.intval(explode('_',$pricerange)[1]) : null ;

        $categoryIds=   '';
        $categoryid =   $categoryid ? $categoryid : 0;
        $page       =   $page ? $page : 1;
        $allCategories          =   self::getAllCategories();
        $allCategoriesArr    =  self::getFilterCatArr($categoryid,$allCategories);
        $categoryIds         =  implode(',', $allCategoriesArr) ? implode(',', $allCategoriesArr) : '';
        //dd("http://seller.digishoppers.com/webservice/productcategoryby/A123456/$page/$categoryIds".$minprice.$maxprice);

        $url        =   "http://seller.digishoppers.com/webservice/productcategoryby/A123456/$page/$categoryIds".$minprice.$maxprice;
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

        if(json_decode($result, true)['error']){
            return false;
            exit;
        }

        return json_decode($result, true)['data'];
    }

    public function getApiProducts($categoryid = null, $page = null){
       
        $categoryid =   $categoryid ? $categoryid : 0;
        $page       =   $page ? $page : 1;

        $url        =   "http://seller.digishoppers.com/webservice/productbycategory/A123456/$page/$categoryid";

       
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

        if(json_decode($result, true)['error']){
            return false;
            exit;
        }

        return json_decode($result, true)['data'];
    }

    

    /*public function api_products_ajax(Request $request){

        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('categoryid') || !$request->has('page')){
            exit;
        }

        //$this->data['apiresults']        =   self::getApiProducts($request->categoryid, $request->page);
        
        $this->data['apiresults']          =  self::getApiMultipleCatProducts($request->categoryid, $request->page);
        if(!$this->data['apiresults']){
            exit;
        }

        foreach($this->data['apiresults']  as $value){
            $apiProduct                     =  ApiProduct::where('api_product_id', $value['id'])->first() ? ApiProduct::where('api_product_id', $value['id'])->first() : new ApiProduct; 
            $apiProduct->api_product_id     =  $value['id'];
            $apiProduct->imageUrl           =  $value['imageUrl'];
            $apiProduct->productTitle       =  $value['productTitle'];
            $apiProduct->categoryId         = $value['categoryId'];
            $apiProduct->mrp                = $value['mrp'];
            $apiProduct->retailPrice        = $value['retailPrice'];
            $apiProduct->sellingPrice       = $value['sellingPrice'];
            $apiProduct->transfer_price     = $value['transfer_price'];
            $apiProduct->margin             = $value['margin'];
            $apiProduct->final_visible_price = $value['final_visible_price'];
            $apiProduct->final_paid_price   = $value['final_paid_price'];
            $apiProduct->description        = $value['description'];
            $apiProduct->committedQuantity  = $value['committedQuantity'];
            $apiProduct->cod                = $value['cod'];
            $apiProduct->weight             = $value['weight'];
            $apiProduct->freeShipping       = $value['freeShipping'];
            $apiProduct->product_images       = $value['productPhoto'];
            $apiProduct->save();
            $this->data['product_img'][$value['id']]   =   explode(',', $value['productPhoto'])[0];
        }

        $page                                          = $data['page']       =  $request->has('page') ? $request->page : 1;
        $this->data['catid']            = $request->categoryid;
        $this->data['previousPage']             = ($page<1) ? 1 : $page-1; 
        $this->data['nextPage']                 = $page+1;
        return view('front/api_product/product_grid', $this->data);
    }*/

    public function api_products_ajax(Request $request){

        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('categoryid') || !$request->has('page')){
            exit;
        }


        //$this->data['apiresults']        =   self::getApiProducts($request->categoryid, $request->page);
        
        $this->data['apiresults']          =  self::getApiMultipleCatProducts($request->categoryid, $request->page, $request->pricerange);
        if(!$this->data['apiresults']){
            exit;
        }

        $apiProductIds                      =   array();
        $dataArray                          =   array();
        foreach($this->data['apiresults']  as $key => $value){
            $apiProductIds[$key]                =  $value['id'];

            $dataArray[$key]                    =   [
                'api_product_id'                =>  $value['id'],
                'imageUrl'                      =>  $value['imageUrl'],
                'productTitle'                  =>  $value['productTitle'],
                'categoryId'                    => $value['categoryId'],
                'mrp'                           => $value['mrp'],
                'retailPrice'                   => $value['retailPrice'],
                'sellingPrice'                  => $value['sellingPrice'],
                'transfer_price'                => $value['transfer_price'],
                'margin'                        => $value['margin'],
                'final_visible_price'           => $value['final_visible_price'],
                'final_paid_price'              => $value['final_paid_price'],
                'description'                   => $value['description'],
                'committedQuantity'             => $value['committedQuantity'],
                'cod'                           => $value['cod'],
                'weight'                        => $value['weight'],
                'freeShipping'                  => $value['freeShipping'],
                'product_images'                => $value['productPhoto'],
            ];
            
            $this->data['product_img'][$value['id']]   =   explode(',', $value['productPhoto'])[0];
        }

        $searchRecords            =   ApiProduct::whereIn('api_product_id', $apiProductIds)->get();

        $existingRecordsid        = array();
        foreach($searchRecords as $searchRecord){
            $existingRecordsid[]    =   $searchRecord->api_product_id;
        }

        $notexistingArrayid         =   array_diff($apiProductIds, $existingRecordsid);

        $updateRecordArr            =   array();
        $insertRecordArr            =   array();
        foreach($dataArray as $recordArr){

            foreach($existingRecordsid as $existingid){
                if($recordArr['api_product_id'] == $existingid){
                    $updateRecordArr[]   = $recordArr;
                    continue;
                }
            }

            foreach($notexistingArrayid as $notexistingid){
                if($recordArr['api_product_id'] == $notexistingid){
                    $insertRecordArr[]   = $recordArr;
                    continue;
                }
            }
        }

        //$updateQue  = ApiProduct::whereIn('api_product_id', $existingRecordsid)->update($updateRecordArr);
        $insertQue  = ApiProduct::insert($insertRecordArr);

        $page                                          = $data['page']       =  $request->has('page') ? $request->page : 1;
        $this->data['catid']            = $request->categoryid;
        $this->data['previousPage']             = ($page<1) ? 1 : $page-1; 
        $this->data['nextPage']                 = $page+1;
        return view('front/api_product/product_grid', $this->data);
    }

    public function api_product_detail(Request $request){
        $data                =   $this->data;
        if(!$request->has('product_id')){
            return \Redirect::back();
        }

        $product             =   ApiProduct::where('api_product_id',$request->product_id)->first();
        
        if(!$product){
            return \Redirect::back();
        }

        $data['product']        =   $product;

        $data['varients']       =   count(explode(',', $product->varients)) ? explode(',', $product->varients) : array() ;

        $data['images']         =   explode(',',$product->product_images);
   
        $data['default_image']  =   count($data['images']) > 0 ? $data['images'][0] : url('no_image.png');
        
        $commissionType           =  CommissionType::where('is_selected','yes')->first();
        $data['commissionType']      =  '';
        if($commissionType){
            $data['commissionType']  =  $commissionType->commission_type;
        }

        $data['product_price'] = array();
        $commission_perc        = 0;
        if(in_array($data['commissionType'], ['standard_commission','category_commission'])){
            if($data['commissionType'] == 'category_commission'){
                $catComm = Categories_commission::where('category_id',$product->categoryId)->first();
                $commission_perc = $catComm ? $catComm->price : $commission_perc;
            }else{
                $standComm = StandardCommission::where('min','<',$product->expected_payout)->where('max','>',$product->expected_payout)->first();
                $commission_perc = $standComm ? $standComm->commission : $commission_perc;
            }
        }

        $data['product_price'][$product->api_product_id] = intval($product->expected_payout+($product->expected_payout * $commission_perc/100));
        $data['product_mrp_price'][$product->api_product_id] = intval(($product->mrp * (100 +$commission_perc))/100);

        return view('front/api_product/product_detail', $data);
    }

    public function fetch_child_Products_ajax(Request $request){

        if(!$request->ajax()){
            exit;
        }


    }
}
