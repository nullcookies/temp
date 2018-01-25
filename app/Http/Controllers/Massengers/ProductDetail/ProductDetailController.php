<?php

namespace App\Http\Controllers\Massengers\ProductDetail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Models\ProductCategory\ProductCategory;
use App\Models\Product\Product,DB;
use App\Http\Controllers\Massengers\Product\ProductController;
use App\Http\Requests\ValidateCheckout\ValidateCheckoutRequest;
use Response;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Checkout\BuyNow;
use App\Models\Checkout\BuyNowProducts;
use App\Http\Requests\Product\UploadCoverImageRequest, File;
use App\DeliveryMethod;
use App\Http\Requests\FetchPincodeRequest, Carbon\Carbon;

class ProductDetailController extends Controller{
    
    protected $data = [];
    protected $product_controller_obj;
    public function __construct(){
    	$this->product_controller_obj = new ProductController;
	}

    public function productdetail(Request $request, $categoryid, $productid){
    	$data = [];
    	$category = Category::where('name_alias',$categoryid)->select('id','category','parentId','name_alias','image_upload_option','delivery_options','combocat','showtimer','love_letter_options')->first();
        //dd($category->delivery_options);

        $data['category'] = $category;
    	if(!$category){
    		echo 'category not exist';
    		exit;
    	}
    	$data['cat_alias'] = $categoryid;
    	$product  =   Product::find($productid);

    	if(!$product){
    		echo 'Product not exist';
    		exit;
    	}

    	$data['product']     =  $product;
    	
    	$data['add_some_more_love'] = DB::table('add_some_more_love_products')->whereIn('id', explode(',', $product->add_some_more_love_products))->get();


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
        ->where('selected_varient_for_product.product_id',$productid)
        ->groupBy('selected_varient_for_product.varient_type_id')
        ->select('selected_varient_for_product.varient_type_id','varient_types.varient_type')
        ->get();

        foreach($data['varientTypes'] as $filterVarient){

            $data['varientValues'][$filterVarient->varient_type_id] = DB::table('selected_varient_for_product')
            ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
            ->where('selected_varient_for_product.product_id',$productid)->where('selected_varient_for_product.varient_type_id',$filterVarient->varient_type_id)->groupBy('selected_varient_for_product.varient_type_value_id')->orderBy('varient_type_values.sort_order','asc')->select('varient_type_values.id','varient_type_values.value','varient_type_values.substract_price','varient_type_values.can_auto_selected')->get();
        }

        $_SESSION['parentId'][] =   array('id' => $category->id, 'category_name' => $category->category,'alias' => $category->name_alias);
        $breadCrumbCategories   =  $this->product_controller_obj->getAllParentArr($category->id, $this->product_controller_obj->getAllCategories());
        $data['breadCrumbCategories'] = array_reverse($breadCrumbCategories);

        $data['stockStatus'] =  ($product->quantity > 0) ? 'In Stock' : 'Not in Stock' ;

        $allSubCategories       =   $this->product_controller_obj->getFilterCatArr($category->id, $this->product_controller_obj->getAllCategories());
        $allProductIds          =   ProductCategory::whereIn('category_id',$allSubCategories)->select('product_id')->groupBy('product_id')->get();
        
        $productArr             =   array();
        foreach($allProductIds as $thisproduct){
            $productArr[]       =   $thisproduct->product_id;
        }

        $data['products'] =   Product::whereIn('product.id',$productArr)->orderBy('id', 'desc')->limit(4)->get();

        foreach($data['products'] as $product){
            $productImage        =  DB::table('product_images')
            ->where ('product_id', $product->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    

            $data['productImage'][$product->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }
        
        $productids = ProductCategory::whereIn('category_id',explode(',',$category->combocat))->select('product_id')->groupBy('product_id')->limit(3)->get();
        
        $productComboArr             =   array();
        foreach($productids as $thisproduct){
            $productComboArr[]       =   $thisproduct->product_id;
        }
        
       $data['combos'] = Product::whereIn('product.id',$productComboArr)->orderBy('id', 'desc')->get();

        foreach($data['combos'] as $combo){
        	$productImage        =  DB::table('product_images')
            ->where ('product_id', $combo->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    
            $data['comboproduct'][$combo->id] = Product::find($combo->id);
            $data['comboproductImage'][$combo->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }
        
        
        $data['recentlyViewProducts'] = Product::select('product.*')->orderBy('id', 'desc')->get()->random(4);
        foreach($data['recentlyViewProducts'] as $combo){
        	$productImage        =  DB::table('product_images')
            ->where ('product_id', $combo->id)
            ->where ('default_image', 'yes')
            ->select('image')
            ->first();    
            $data['recentproduct'][$combo->id] = Product::find($combo->id);
            $data['recentproductImage'][$combo->id] = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 
        }
        
        $data['delivery_options'] = DeliveryMethod::whereIn('id',explode(',',$category->delivery_options))->get();
        
        
        $data['timer'] = Carbon::parse(Carbon::today())->addHours(17)->format('M d, Y H:i:s');
        
        //dd($data['timer']);
  
    	return view('massengers/product/productdetail/productdetail',$data);
    }

    public function validatebeforecheckout(ValidateCheckoutRequest $request){
        if(!$request->ajax()){
            exit;
        }

        $buynow = new BuyNow;
        foreach($request->all() as $key => $value){
            $$key = $value;
        }

        if(!$category = Category::where('name_alias',$category)->select('id','category','parentId','name_alias','love_letter_options','image_upload_option')->first()){
            return Response::json(['message' => 'Selected Category does not exist with us'],421);exit;
            exit;
        }
        
        // error
        //return Response::json(['message' => 'Validating'],421);exit;

        $categoryid = $category->id;
        $category_alias = $category->name_alias;
        
        
        $add_more_love = '';
        if($request->has('add_more_love')){
            $add_more_love   = implode(',', $request->add_more_love);
        }
        
        if(!$product  =  Product::find($productid)){
            return Response::json(['message' => 'Requested Product does not exist in our inventory'],421);exit;
        }
        
        if($product->image_upload_option == 'no'){
            goto bypassimageupload;
        }
        
        if(!$request->has('cover_photo')){
            return Response::json(['message' => 'Please upload the image'],421);exit;
        }

        bypassimageupload: ''; 
        
        if($product->love_letter_options == 'no'){
            goto bypassloveletter;
        }
        
        if(!$request->has('paper_color')){
            return Response::json(['message' => 'Please Select Paper Color'],421);exit;
        }
        
        if(!$request->has('ink_colour')){
            return Response::json(['message' => 'Please Select Ink Color'],421);exit;
        }
        
        if(!$request->has('emotions')){
            return Response::json(['message' => 'Please Select Emotions'],421);exit;
        }
        
        if(!$request->has('receipent_name')){
            return Response::json(['message' => 'Please Write Receipent Name'],421);exit;
        }
        
        if(!$request->has('not_sure_what_to_say')){
            
            if(!$request->has('loveletter_message')){
                return Response::json(['message' => 'Please Write Message'],421);exit;
            }
        }
        
        bypassloveletter: '';
        
        if($product->quantity < $quantity){
            return Response::json(['message' => 'Your required quantity for that product is not available for now'],421);exit;
        }

        $productImage        =  DB::table('product_images')->where ('product_id', $product->id)->where ('default_image', 'yes')->select('image')->first();   
        $productImage        = ($productImage && \File::exists(public_path('/product_images/200x200/'.$productImage->image))) ? url('/product_images/200x200/'.$productImage->image) : url('no_image.png'); 

        if(! $date = HelperController::validateDate($selectedDate)){
            return Response::json(['message' => 'Please fill a accurate date'],421);exit;
        }

        $buynow->selected_delivery_date = $date;
        $buynow->shipping_time          = $delivery_option;
        $buynow->delivery_option        = $shippingtime;
        $buynow->shipping_pincode       = $pincode;
        $buynow->shipping_city          = $delivery_city;

        if(!$buynow->save()){
            return Response::json(['message' => 'An unknown problem occured during order place process'],202);exit;
        }

        $buynow_product                 = new BuyNowProducts;

        $buynow_product->upc            = $product->id;
        $buynow_product->product_description = $product->product_description;
        $buynow_product->product_mrp   = $product->product_mrp;
        $buynow_product->product_selling_price   = $product->product_selling_price;
        
        if($request->has('varients')){
            $buynow_product->varients            = $request->varients;
        }else{
            $buynow_product->varients            = 0;
        }
        
        $buynow_product->product_from        = 'normal';
        $buynow_product->quantity            = $quantity;
        $buynow_product->buy_now_id        = $buynow->id;
        $buynow_product->product_name            = $product->product_name;
        $buynow_product->weight        = $product->weight;
        $buynow_product->image        = $productImage;
        $buynow_product->selected_delivery_date = $date;
        $buynow_product->shipping_time          = $delivery_option;
        $buynow_product->delivery_option        = $shippingtime;
        
        if($request->has('cover_photo')){
            $buynow_product->cover_photo        = $request->cover_photo;
        }
        
        if($request->has('paper_color')){
            $buynow_product->paper_color        = $request->paper_color;
        }
        
        if($request->has('ink_colour')){
            $buynow_product->ink_colour        = $request->ink_colour;
        }
        
        if($request->has('emotions')){
            $buynow_product->emotions        = $request->emotions;
        }
        
        if($request->has('receipent_name')){
            $buynow_product->receipent_name        = $request->receipent_name;
        }
        
        if($request->has('message')){
            $buynow_product->message        = $request->message;
        }
        
        if($request->has('add_more_love')){
            $buynow_product->has_add_more_love = 'yes'   ;
        }
        
        $buynow_product->add_more_love_products_id = $add_more_love;

        if(!$buynow_product->save()){
            BuyNow::where('id',$buynow->id)->delete();
            return Response::json(['message' => 'An unknown problem occured during order place process'],202);exit;
        }

        return Response::json(['message' => 'successfully validated','buynow' => $buynow->id],202);exit;
    }
    
    
    public function uploadImage(UploadCoverImageRequest $request){
        	if(!$request->ajax()){
    		exit;
    	}

    	$file = $request->file('photo');
    	$imageName = time().'.'.$file->getClientOriginalExtension();
    	$folderpath = '/public/massengers/checkout/';
    	$path  = base_path().$folderpath;
    	$fileUrl = url($folderpath.''.$imageName);
    	
    	if(!$file->move($path, $imageName)){
    		return Response::json(array('fail' => 'true', 'message' => 'File could not uploaded, try again', 'class' => 'error'));exit;
    	}
    	return Response::json(array('success' => 'true', 'message' => 'File Uploaded Successfully', 'class' => 'success', 'file_url' => $fileUrl, 'file_name' => $imageName)); exit;
    }
    
    public function getnotificationproducts(Request $request){
        if(!$request->ajax()){
            exit;
        }
        
        $product = Product::join('product_category','product_category.product_id','=','product.id')
        ->join('product_images','product_images.product_id','=','product.id')
        ->join('category','category.id','=','product_category.category_id')
        ->where('product_images.default_image','yes')
        ->select('product.id','category.category','category.name_alias','product.product_name','product_images.image')->get()->random(1);
        
        if(!$product){
            return Response::json(['message' => 'An unknown problem occured during order place process'],421);exit;
        }
        
        $url = url('/category/'.$product->name_alias.'/product/'.$product->id);
        $image_url = File::exists(public_path('/product_images/50x50/'.$product->image)) ?url('product_images/50x50/'.$product->image): url('no_image.png');
        
        return Response::json(['product_name' => $product->product_name, 'url' => $url, 'image_url' => $image_url],202);exit;
    }
    
    public function fetchpincode(FetchPincodeRequest $request){
        
        if(!$request->ajax()){
            exit;
        }
        
        $pincode = DB::table('pincodes')->where('pincode',$request->pincode)->first();
        
        if(!$pincode){
            return Response::json(['message' => 'We are not available for this pincode'],421);exit;
        }
        
        return Response::json(['city' => $pincode->city_name],202);exit;
    }
    
    public function suggestpincode(Request $request){
        if(!$request->ajax()){
            exit;
        }
        
        $pincode = DB::table('pincodes')->where('city_name','like',$request->str.'%')->orWhere('pincode', 'like', $request->str.'%')->groupBy('pincodes.id')->select('id','pincode','city_name')->limit(20)->get();
        
        return view('massengers/product/productdetail/suggestpincode', ['pincodes' => $pincode ]);
    }

    public function fetchdeliveryoptions(Request $request){

        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('deliveryoptions')){
            exit;
        }
        $data = [];
        $data['delivery_options'] = DeliveryMethod::whereIn('id',explode(',',$request->deliveryoptions))->orderBy('sort_order')->get();

        return view('massengers/product/productdetail/ajaxdeliveryoptions', $data);
    }

    public function fetchdeliverycalender(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('deliveryoption')){
            exit;
        }
        
        if($request->deliveryoption == 'standard_delivery'){
            $data = [];
            $data['date'] = Carbon::parse(Carbon::today())->addDays(7)->format('Y-m-d');
            $data['dateforuser'] = Carbon::parse(Carbon::today())->addDays(7)->format('D d-M-Y');
            return view('massengers/product/productdetail/autodateselect', $data);
        }else{
            $data = [];
            return view('massengers/product/productdetail/fetchdeliverycalender', $data);
        }
    }
    
    public function fetchdeliverytimings(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('deliveryoption')){
            exit;
        }
        
        if(!$request->has('date')){
            exit;
        }
        
        $delivery_method = DB::table('delivery_methods')->where('alias', $request->deliveryoption)->first();
        
        if(!$delivery_method){
            exit;
        }
        
        $shipping_price = 150;
        
        if($delivery_method->alias == 'standard_delivery'){
            $shipping_price = 'Free';
        }
        
        $currentDate = strtotime(Carbon::parse(Carbon::today())->format('d-m-Y'));
        
        $selectedDate = strtotime(Carbon::parse($request->date)->format('d-m-Y'));
        
        $delivery_timings = [];
        if($selectedDate > $currentDate){
            $delivery_timings = DB::table('delivery_timings')->where('delivery_method_id', $delivery_method->id )->get();
        }else{
            $delivery_timings = DB::table('delivery_timings')->where('delivery_method_id', $delivery_method->id )->where('rangeVal', '>=', intval(Carbon::parse(Carbon::now(new \DateTimeZone('Asia/Kolkata')))->format('H')))->get();
        }
        
        return view('massengers/product/productdetail/fetchdeliverytimings',['delivery_timings' => $delivery_timings ,'delivery_option' => $delivery_method , 'shipping_price' => $shipping_price]);
    }
}
