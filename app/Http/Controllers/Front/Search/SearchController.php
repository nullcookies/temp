<?php

namespace App\Http\Controllers\Front\Search;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, Redirect, DB;
use App\Models\Product\Product, App\Models\ProductCategory\ProductCategory;
use App\Models\Api\ApiProduct;
use App\Models\Subscription\Newsletter;

class SearchController extends Controller{
    
    public $data;

    public function __construct(){
    	$this->data 		=	array();
    }

    public function index(Request $request){
        
        if(!$request->has('q')) {
            return Redirect::back();
        }

        if(strlen($request->q)<1){
            return Redirect::back();
        }

        $data       =   $this->data;

        $searchVal  = $data['searchVal']  =   $request->q;

        $data['results'] = Product::join('product_category','product_category.product_id','=','product.id')
        ->join('category','category.id','=','product_category.category_id')
        ->where('product.product_name', 'like', '%'.$searchVal.'%')
        ->where('product.deleted','no')
        ->select('product.id','product.product_name','category.category','category.id as category_id','product.product_mrp','product.product_selling_price')
        ->paginate(12);
        $normalProductIds[]    = array();
        foreach($data['results'] as $result){
            $normalProductIds[]   = $result->id;
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $result->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    
            $data['image'][$result->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }

        $data['apiProducts'] =  self::getApiSearchProduct($searchVal);
        $apiProductIds                      =   array();
        if($data['apiProducts']){
            
            $dataArray                          =   array();
            foreach($data['apiProducts']  as $key => $value){
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
                    'seller_id'                     => $value['recordInsertedBy'],
                    'expected_payout'               => $value['expected_payout'],
                ];
                
                $data['api_product_img'][$value['id']]   =   explode(',', $value['productPhoto'])[0];
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
        $page                     = $data['page']       =  $request->has('page') ? $request->page : 1;
        $data['previousPage']             = ($page<1) ? 1 : $page-1; 
        $data['nextPage']                 = $page+1;
        //dd($data);
        return view('front/search/showSearchResult', $data);
    }

    public function getApiSearchProduct($serach, $page = null){
        $page       =   $page ? $page : 1;
        $search     =   urlencode($serach);
        $url        =   "http://seller.digishoppers.com/webservice/productsearch/A123456?search=$search";
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

    public function store(Request $request){

    	if(!$request->ajax()){
    		echo 'bad request';
    		exit;
    	}

        if(!$request->has('value')){
            echo 'Invalid parameters';
            exit;
        }

        $data       =   $this->data;

    	$searchVal 	=	$request->value;

        $data['results'] = Product::join('product_category','product_category.product_id','=','product.id')
        ->join('category','category.id','=','product_category.category_id')
        ->where('product.product_name', 'like', '%'.$searchVal.'%')
        ->where('product.deleted','no')
        ->select('product.id','product.product_name','category.category','category.id as category_id')
        ->paginate(7);
    	
        return view('front/search/ajax/searchResult', $data);
    }
    public function newsletter(Request $request)
    {
       // dd($request->all());
        $this->validate($request, [
            //'email' => 'required|email|unique:newsletter',
            'email' => 'required|email|unique:newsletter',
        ]);
        $result = Newsletter::create($request->all());
        //dd($result);
        return redirect('/')->with('success','Subscription submitted successfully');         
    }
}
