<?php

namespace App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductUploadRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\SaveProductUpdateRequest;
use App\Http\Requests\Product\BulkUploadRequest;
use App\Traits\Categories;
use App\Http\Requests;
use Illuminate\Http\Request;
use View, Auth, Session;
use App\User, DB, Redirect, Image, Response, Crawler;
use App\Http\Controllers\Cron\CronController;
use App\Http\Controllers\Admin\Product\ProductHelper;
use App\Models\Product\Inventory;
use App\Models\Product\Product;
use Excel;
use App\Category;
use App\Models\Varient\VarientType;
use App\Models\Varient\SelectedVarient;
use App\Models\Varient\VarientTypeValue;
use App\Models\Checklist\CheckList;
/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class ProductController extends Controller{
    
    use Categories;
    
    public $data;

    public function __construct(Inventory $inventory){
        $this->data             =   array();
        $this->inventoryTable     = $inventory;
    }

    public function uploadProduct(Request $request){
        // write your code here
        $data                   =   $this->data;
        return view('admin/product/allUploadOptions',$data);
    }
    public function setDefaultImage($productid)
    {
        $productimage = DB::table('product_images')
                        ->where ('product_id', $productid)
                        ->where ('default_image', 'yes')
                        ->select('image')
                        ->first();  
        if(!empty($productimage->image)){
            return url('/product_images/50x50/'.$productimage->image);
        }else{
            return url('no_image.png');
        } 
    }
    public function index(Request $request){

        $data                   =   $this->data;
        $pr_obj                 =   new ProductHelper;
        $recoardPerpage         =   10;
        $products               =   DB::table('product')
        ->leftJoin('product_images','product_images.product_id','=','product.id')
        ->join('product_category','product_category.product_id','=','product.id')
        ->orderBy('product.id', 'DESC');
        
        if(count($products)){
            $checklist = CheckList::first() ? CheckList::first() : new CheckList;
            $checklist->upload_product_checked = 'yes';
            $checklist->save();
        }
        
        if($request->c && !is_null($request->c) && strlen($request->c)>0){
            $searchVar          =   $request->c;

            $categories         =   DB::table('category')->where('category','like','%'.$searchVar.'%')->select('id')->get();

            $searchCat          =   array();
            foreach ($categories as $category) {
                $searchCat[]    =   $category->id;
            }

            $searchProduct      =   DB::table('product_category')->whereIn('category_id',$searchCat)->groupBy('product_id')->select('product_id')->get();
            $searchPro          =   array();

            foreach ($searchProduct as $pro) {
                $searchPro[]    =   $pro->product_id;
            }

            $products           =   $products->where(function($query) use ($searchVar,$searchPro ){
                $query->where('product.product_name','like','%'.$searchVar.'%')->orWhere('product.sku','like','%'.$searchVar.'%');
                $query->orWhereIn('product.id',$searchPro);
            });
        }
        
        $data['products']       =   $products->where('deleted','no')/*->where('product_images.default_image', 'yes')*/
        ->select('product.id as upc','product_images.image as product_image','product.sku','product.product_mrp','product.product_selling_price','product.product_name','product.quantity')
        ->groupBy('product.id')
        ->paginate($recoardPerpage);

        $productcategory = DB::table('product_category')
        ->leftJoin('category', 'category.id', '=', 'product_category.category_id')        
        ->select(['product_category.id', 'product_category.product_id', 'product_category.category_id', 'category.category'])
        ->where('category.deleted', 'no')
        ->get();        
        //->toSql();             dd($productcategory);
        $data['category'] = $categories = [];
        foreach ($productcategory as $key => $category) {            
            $dd[$category->product_id][]                      = $category->category;
            $data['category'][$category->product_id]          = implode(', ', $dd[$category->product_id]);
        }
        
        $data['current_page']   = $data['products']->currentPage();
        $data['index_items']    = ($recoardPerpage*$data['current_page'])-($recoardPerpage-1);
        
        return view('admin/product/show_product',$data);
    }

    public function create(Request $request){
        $data                   =   $this->data;
        $data['categories']     =   array(); //DB::table('categories')->get();

        if(Session::has('product_image_key')){
            Session::forget('product_image_key');
        }

        Session::set('product_image_key',time());

        $data['product_session_key']    =   Old('product_session_key') ? Old('product_session_key') :Session::get('product_image_key');

        $data['uploadedImages']         =   DB::table('pending_product_image')->select('image_url')->where('session_key',$data['product_session_key'])->get();
        $data['categories']             = $this->getAllParents();
        return view('admin/product/product',$data);
    }
    
   public function uploadMultiImages(Request $request){

        if(!$request->ajax()){
            exit;
        }

        if($request->hasFile('product_image')){
            $destination = public_path().'/product_images';

            $dim10                          =   '10x10';
            $dim20                          =   '20x20';
            $dim50                          =   '50x50';
            $dim100                         =   '100x100';
            $dim200                         =   '200x200';
            $dim300                         =   '300x300';
            $dim500                         =   '500x500';

            $image_url                      =   '';
            if(!file_exists($destination)){
                mkdir($destination);
            }

            if(!file_exists($destination.'/'.$dim10)){
                mkdir($destination.'/'.$dim10);
            }

            if(!file_exists($destination.'/'.$dim20)){
                mkdir($destination.'/'.$dim20);
            }

            if(!file_exists($destination.'/'.$dim50)){
                mkdir($destination.'/'.$dim50);
            }

            if(!file_exists($destination.'/'.$dim100)){
                mkdir($destination.'/'.$dim100);
            }

            if(!file_exists($destination.'/'.$dim200)){
                mkdir($destination.'/'.$dim200);
            }

            if(!file_exists($destination.'/'.$dim300)){
                mkdir($destination.'/'.$dim300);
            }

            
            if(!file_exists($destination.'/'.$dim500)){
                mkdir($destination.'/'.$dim500);
            }

            $image       = $request->file('product_image');
            $filename    = time().'.'.$image->getClientOriginalExtension();

            if($image->move($destination, $filename)){
                $uploaded                   =   $destination.'/'.$filename ;
                Image::make($uploaded)->resize(10, 10)->save($destination.'/'.$dim10.'/'.$filename);
                Image::make($uploaded)->resize(20, 20)->save($destination.'/'.$dim20.'/'.$filename);
                Image::make($uploaded)->resize(50, 50)->save($destination.'/'.$dim50.'/'.$filename);
                Image::make($uploaded)->resize(100, 100)->save($destination.'/'.$dim100.'/'.$filename);
                Image::make($uploaded)->resize(200, 200)->save($destination.'/'.$dim200.'/'.$filename);
                Image::make($uploaded)->resize(300, 300)->save($destination.'/'.$dim300.'/'.$filename);
                Image::make($uploaded)->resize(500, 500)->save($destination.'/'.$dim500.'/'.$filename);
                
                DB::table('pending_product_image')->insert(array(
                    'image_url'   => $filename,
                    'session_key' => $request->product_session_key,
                ));

                $image_url = url('product_images/'.$filename);
            }
        }

        return Response::json(array('success' => 'true','image_url' => $image_url ));
    }
    public function save(ProductUploadRequest $request){
  
        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }

        $dimension              =   'none';

        if(isset($dimension_lenght) && isset($dimension_width) && isset($dimension_height)){
            $dimension              =   $dimension_lenght.'x'.$dimension_width.'x'.$dimension_height;
        }

        $substract_stock        =   ($request->substract_stock) ? 'yes' : 'no';

        $product                =   DB::table('product')->insertGetId(array(
            'product_name'                  =>  $product_name,
            'product_description'           =>  $product_desc,
            'brand'                         =>  $brand,
            'weight'                        =>  $weight,
            'dimensions'                    =>  $dimension,
            'substract_stock'               =>  $substract_stock,
            'sku'                           =>  $product_sku,
            'model'                         =>  $product_model,
            'product_mrp'                   =>  $mrp,
            'product_selling_price'         =>  $selling_price,
            'quantity'                      =>  $product_quantity,
            'meta_title'                    =>  $meta_title,
            'meta_description'              =>  $meta_decription,
            'meta_keywords'                 =>  $meta_keywords,
            'product_tags'                  =>  $product_tags,
            'isbn'                          =>  $product_isbn,
            'asin'                          =>  $product_asin,
            'ean'                           =>  $product_ean,
            'maximum_order_quantity'        =>  $maximum_order_quantity,
            'minimum_order_quantity'        =>  $minimum_order_quantity,
        ));

        if(!$product){
            return Redirect::back();
        }

        foreach ($request->category as $category) {
            DB::table('product_category')->insert(array('product_id' => $product, 'category_id' => $category));
        }

        if($request->has('product_session_key')){
            $pendingImages = DB::table('pending_product_image')->select('image_url')->where('session_key',$request->product_session_key)->get();
            $imageArr      = array();
            $default       = 'yes';
            foreach($pendingImages as $pendingImage){
                $imageArr[]  = ['image' => $pendingImage->image_url, 'default_image' => $default, 'product_id' => $product];
                $default   = 'no';
            }

            DB::table('product_images')->insert($imageArr);
        }
        $imageid = DB::table('product_images')->where('default_image','yes')->where('product_id',$product)->first();
        Session::flash('saved_successfully','true');

        //return Redirect::back();
        return redirect('admin/product/imagescrop?upc='.$product.'&redir=true&id='.$imageid->id);
        //return redirect('/admin/product/editProduct?c='.$product);
    }

    public function showBulkupload(Request $request){

        $data                       =   $this->data;
        $data['categories'] = $this->getAllParents();
        return view('admin/product/bulkUpload',$data);
    }

    // new upload function 
    
     public function upload_by_csv(BulkUploadRequest $request){
        $file                       =   $request->file('product_csv');
        session(['categories' => $request->category]);
        $excelData = Excel::selectSheets('UploadData')->load($file->getRealPath(), function($render){ 
            $render->each(function($row,$request){
                $productArr                 =   array();
                $notUploadedArray           =   array();
                $imageArray                 =   array();
                $supported_image = ['jpeg','png','jpg'];
                $error = false;
                if(!$row->has('product_name')){
                    $error = true;
                }

                if(!$row->has('product_description')){
                    $error = true;
                }

                if(!$row->has('weight') || !is_numeric($row->weight)){
                    $error = true;
                }

                if(!$row->has('product_mrp') || !is_numeric($row->product_mrp)){
                    $error = true;
                }

                if(!$row->has('product_selling_price') || !is_numeric($row->product_selling_price)){
                    $error = true;
                }

                if(!$row->has('quantity') || !is_numeric($row->quantity)){
                    $error = true;
                }

                if(!$row->has('image1') || !in_array(strtolower(pathinfo($row->image1, PATHINFO_EXTENSION)),$supported_image)){
                    $error = true;
                }

                if($error){
                    foreach($row as $key => $value){
                        $prepareProduct[$key] =  $value;
                    }
                    $notUploadedArray  = $prepareProduct;
                }else{
                    $prepareProduct    = array();
                    foreach($row as $key => $value){
                        
                        if(in_array($key, ['product_name','product_description','brand','weight','dimensions','sku','product_mrp','product_selling_price','quantity','isbn','meta_title','meta_description','meta_keywords']) && !in_array($key,['image1','image2','image3',''])){
                            $prepareProduct[$key] =  $value;
                        }
                    }
                    $productArr      = $prepareProduct;
                }

                $product     = 0;
                if(count($productArr)){
                    
                    $product = DB::table('product')->insertGetId($productArr);
                }
                
                $imageArray[] = [
                        'image'         => $row->image1,
                        'default_image' => 'yes',
                        'product_id'    => $product,
                    ];
                    
                if($row->has('image2') && in_array(strtolower(pathinfo($row->image2, PATHINFO_EXTENSION)),$supported_image)){
                    $imageArray[] = [
                        'image'         => $row->image2,
                        'default_image' => 'no',
                        'product_id'    => $product,
                    ];
                }

                if($row->has('image3') && in_array(strtolower(pathinfo($row->image3, PATHINFO_EXTENSION)),$supported_image)){
                    $imageArray[] = [
                        'image'         => $row->image3,
                        'default_image' => 'no',
                        'product_id'    => $product,
                    ];
                }
                
                if($product){
                    foreach (session('categories') as $category) {
                        DB::table('product_category')->insert(array('product_id' => $product, 'category_id' => $category));
                    }
                    DB::table('product_images')->insert($imageArray);
                }
            });
        })->get();
        
        return redirect('/admin/product');
    }


    public function fetchCategory(Request $request){
        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }
        $data                   =   $this->data;
        $category               =   strlen($request->category)>0 ? $request->category : 'hiphiphurrey';
        $data['results']        =   DB::table('category')->where('category','like','%'.$category.'%')->paginate(10);
        return view('admin/product/ajax/showCategory',$data);
    }

    public function setupcategory(Request $request){
        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }
        $data                   =   $this->data;    
        $data['results']        =   DB::table('category')->where('id',$request->catid)->get();
        return view('admin/product/ajax/setCategory',$data);
    }

    public function uploadFromLink(Request $request){

        $data                   =   $this->data;
        return view('admin/product/uploadFromLink',$data);
    }

    /* parse from link*/
    /*public function getparse(Request $request){

        $data                   =   $this->data;

        $url                    =   $request->link;
        if(filter_var($url, FILTER_VALIDATE_URL) === false){
            echo 'Invalid Url';
            exit;
        }

        $parse_url              =   parse_url($request->link);
        if($parse_url['host'] == 'paytm.com'){
            $this->parsePaytm($url);
        }
    }*/

    /* parse paytm */

    /*public function parsePaytm($url){
        $data                   =   $this->data;
        $crawler                =   Crawler::request('GET', $url);

        $product                =   DB::table('parsed_items')->insertGetId(array());

        $data['product_title']  =   $crawler->filter('.ZGeF .K_rF .NZJI')->text();
        
        $data['product_description']    =   $crawler->filter('._2QHU a')->text();

        $data['mrp']            =   $crawler->filter('._2CkE._30zs')->text();
        $data['mrp']    = intval(preg_replace('/[^0-9]+/', '', $data['mrp']), 10);
        

        $data['selling_price']  =   $crawler->filter('._1d5g')->text();
        
        $data['selling_price']  =   intval(preg_replace('/[^0-9]+/', '', $data['selling_price']), 10);
        
        $data['product_description'] = $crawler->filter('.aile')->text();

        $data['image']          =   $crawler->filter('._1-Zc img')->attr('src');

        dd($data) ;die;
    }*/

    public function editProduct(ProductUpdateRequest $request){
        $data                   =   $this->data;
        $data['result']         =   Product::join('product_category','product_category.product_id','=','product.id')
                                    ->where('product.id',$request->c)
                                    ->select('product.id','product.product_name','product.product_description','product.brand','product.substract_stock','product.sku','product.model','product.product_mrp','product.product_selling_price','product.quantity','product.weight','product.dimensions','product.meta_title','product.meta_description','product.meta_keywords','product.product_tags','product.isbn','product.asin','product.ean','product.requires_shipping','product.maximum_order_quantity','product.minimum_order_quantity')
                                    ->first();

        $dimension                       =   explode('x', $data['result']->dimensions);
        $data['l']                       =   isset($dimension[0]) ? $dimension[0] : '';
        $data['b']                       =   isset($dimension[1]) ? $dimension[1] : '';
        $data['h']                       =   isset($dimension[2]) ? $dimension[2]: '';

        $data['categories']              =   DB::table('product_category')->where('product_id',$data['result']->id)->get();

        foreach ($data['categories'] as $category) {
            $data['selectedCat'][$category->category_id]     =   DB::table('category')->where('id',$category->category_id)->first() ? DB::table('category')->where('id',$category->category_id)->first()->category : 0; ;
        }
        
        $data['product_categories']      = $data['categories'];

        if(!$data['result']){
            return redirect(ADMIN_URL_PATH.'/product');
            exit;
        }
        
        $data['categories']  = Category::get();

        $product_category_ids = array();
        foreach($data['product_categories'] as $product_category){
            $product_category_ids[] = $product_category->category_id;
        }
        
        $data['product_category_ids'] = ($product_category_ids);
        
        /* new code appended */

        $data['varients']             =  VarientType::all();

        $data['assignedVarients']     =  SelectedVarient::join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')->where('selected_varient_for_product.product_id', $data['result']->id)->select('selected_varient_for_product.*','varient_type_values.value')->orderBy('selected_varient_for_product.id')->get();

        $selectedValues     =  array();
        foreach($data['assignedVarients'] as $assignedVarients):
            $selectedValues[]         = $assignedVarients->varient_type_value_id;
        endforeach;

        $data['availableVarients']    = VarientTypeValue::getNotSelected($selectedValues);

        $product_varient_price      =   DB::table('product_varient_price')->where('product_id',$data['result']->id)->get();
        $productPrice = array();
        foreach ($product_varient_price as $key => $value) {
            $varients = Self::varienttypeByid($value->varients);  // Return String            
            $productPrice[$key]['id']         = $value->id;
            $productPrice[$key]['product_id'] = $value->product_id;
            $productPrice[$key]['varients']   = $varients;
            $productPrice[$key]['price']      = $value->price;
        }
        $data['productVarient'] = $productPrice;
        /*Product Default Image*/
        $data['image']=   $productimage = DB::table('product_images AS p')
                                ->where('p.product_id', $request->c)
                                ->where('p.default_image', 'yes')
                                ->select('p.id','p.image','p.default_image','p.product_id as upc')        
                                ->first();
                                 
        $data['folder'] = 'product_images';
        $data['imagename'] = isset($productimage->image) ? $productimage->image : '' ;

        $data['openAttr']  = $request->has('open') ? true: false;
        return view('admin/product/edit_product', $data);
    }
    
    public function varienttypeByid($varienttypeid){        
        $data = DB::table('varient_type_values')->whereIn('id',explode(',',$varienttypeid))->select(['value'])->get();
        foreach ($data as $key => $value) {
            $dd[] = $value->value;
        }
        return(implode(' + ',$dd));
    }

    public function saveEditProduct(SaveProductUpdateRequest $request){

        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }
        
        $dimension              =   $dimension_lenght.'x'.$dimension_width.'x'.$dimension_height;

        $substract_stock        =   ($request->substract_stock) ? 'yes' : 'no';

        $product                =   DB::table('product')->where('id',$product_id)->update(array(
            'product_name'                  =>  $product_name,
            'product_description'           =>  $product_desc,
            'brand'                         =>  $brand,
            'weight'                        =>  $weight,
            'dimensions'                    =>  $dimension,
            'substract_stock'               =>  $substract_stock,
            'sku'                           =>  $product_sku,
            'model'                         =>  $product_model,
            'product_mrp'                   =>  $mrp,
            'product_selling_price'         =>  $selling_price,
            'quantity'                      =>  $product_quantity,
            'meta_title'                    =>  $meta_title,
            'meta_description'              =>  $meta_decription,
            'meta_keywords'                 =>  $meta_keywords,
            'product_tags'                  =>  $product_tags,
            'isbn'                          =>  $product_isbn,
            'asin'                          =>  $product_asin,
            'ean'                           =>  $product_ean,
            'maximum_order_quantity'        =>  $maximum_order_quantity,
            'minimum_order_quantity'        =>  $minimum_order_quantity,
        ));

        if(!$product){
            return Redirect::back();
        }

        $categories                         =  DB::table('product_category')->where('product_id',$product_id)->delete();

        foreach ($request->category as $category) {
            DB::table('product_category')->insert(array('product_id' => $product_id, 'category_id' => $category));
        }

        return redirect(ADMIN_URL_PATH.'/product');

    }

    public function deleteProduct(ProductUpdateRequest $request){

        $product            =   DB::table('product')->find($request->c);
        if(!$product){
            return redirect(ADMIN_URL_PATH.'/product');
            exit;
        }

        $deleteProduct      =   DB::table('product')->where('id',$request->c)->update(array('deleted' => 'yes'));
        return redirect()->back();        
    }

    /*Code By Jayvardhan Mani*/
    public function productimages(Request $request)
    {        
        $data               = $this->data;     
        $data['productdata']= $product = DB::table('product')->where('id', $request->upc)->select(['id','product_name'])->first();
        
        if(isset($product->id)){
            $data['images']=   $productimage = DB::table('product_images AS p')
                                ->where('p.product_id', $request->upc)
                                ->select('p.id','p.image','p.default_image','p.product_id as upc')        
                                ->get();
            
            foreach ($productimage as $value) {                
                $chk[] = ($value->default_image == 'no') ? $value->id : 0;
            }            
            if(isset($chk) && !in_array(0,$chk,TRUE)){                
                DB::table('product_images')->where('id',$chk[0])->update(['default_image'=> 'yes']);                 
            }
            //dd($chk);
            return view(ADMIN_URL_PATH.'/product/product_images',$data);
        }else{
            return redirect(ADMIN_URL_PATH.'/product');
        }
    }
    public function ajaxcall(Request $request)
    {

       $product_images   =   DB::table('product_images')->find($request->imageid);
       if(!$product_images){
            return redirect(ADMIN_URL_PATH.'/product/product_images');
            exit;
        }
        $datareset   = DB::table('product_images')->where('product_id', $request->product_id)->update(array('default_image' => 'no'));
        $data        = DB::table('product_images')->where('id',$request->imageid)->update(array('default_image' => 'yes'));
        if($datareset){
            return Response::json(array('success' => 'true', 'msg' => 'Default Image Selected'));
        }        
    }
    /*public function imageUploadPost(Request $request)
    {        
        foreach ($request->image as $key => $productimage) {
            
           /* $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);*//*
            
            $imageName = time().$key.'.'.$productimage->getClientOriginalExtension();
            //pr($imageName);
            $productimage->move(public_path('product_images'), $imageName);
            DB::table('product_images')->insert(array(
                        'image'         =>    $imageName,
                        'default_image' =>    'no',
                        'product_id'    =>    $request->product_id,
                    ));
            $cron_obj = new CronController;
            $cron_obj->cropImages($imageName);
        }
        //dd("MANI");
        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }*/
    public function imageUploadPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('product_images'), $imageName);
        DB::table('product_images')->insert(array(
                    'image'         =>    $imageName,
                    'default_image' =>    'no',
                    'product_id'    =>    $request->product_id,
                ));
        $cron_obj = new CronController;
        $cron_obj->cropImages($imageName);
        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }
    public function imagescrop(Request $request)
    {        
            $data               = $this->data; 
            $data['imgpath']      = "product_images";
            $data['width']      = "400";
            $data['height']      = "400";
            $productImage    =   DB::table('product_images AS p')
                                ->where('p.id', $request->id)
                                ->select('p.id','p.image','p.default_image','p.product_id')        
                                ->first();
            // dd($productImage);
            $data['img']  = $productImage->image;
            $data['id']  = $request->id;
            $data['redir'] = $request->has('redir') ? true : false;
            $data['upc'] = $request->has('upc') ? $request->upc : 0; 
            return view(ADMIN_URL_PATH.'/product/imagecrop',$data);
        
    }
    function base64ToImage($base64_string,$imgname,$output_file) {
        $img = $base64_string;
        $img = str_replace('data:image/png;base64,', '', $img);
        
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = public_path($output_file).'/'.$imgname;
        $success = file_put_contents($file, $data);
        $imginfo = getimagesize($file);
        $width  = $imginfo[0];
        $height = $imginfo[1];
        if($success){
            Image::make($file)->resize($width, $height)->save($file);
        }
        $this->placeImage('product_images',$imgname);
        return $success  ? true : false;
    }
    public function saveimagescrop(Request $request)
    { 
        $url = "";
        if($request->has('imgdata') && $request->has('imagename') && $request->has('path')){
            $this->base64ToImage($request->imgdata,$request->imagename,$request->path);             
            $url = url('admin/product/productimages?upc='.$request->upc);

            if($request->has('redir')){
                $url = url('/admin/product/editProduct?c='.$request->upc.'&open=varient');
            }
        }
        return Response::json(array('link' => $url));       
    }
    public function deleteimage(Request $request)
    {
        $id         = $request->id;
        $image      = \DB::table('product_images')->where('id', $id)->first();
        $file       = $image->image;
        //$filename   = public_path().'/product_images/'.$file;
        $dim10                          =   '10x10';
        $dim20                          =   '20x20';
        $dim50                          =   '50x50';
        $dim100                         =   '100x100';
        $dim200                         =   '200x200';
        $dim300                         =   '300x300';
        $dim500                         =   '500x500';
        \File::delete(public_path().'/product_images/'.$file);
        \File::delete(public_path().'/product_images/'.$dim10.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim20.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim50.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim100.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim200.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim300.'/'.$file);
        \File::delete(public_path().'/product_images/'.$dim500.'/'.$file);
       
        $deleted    = \DB::table('product_images')->where('id', $id)->delete();
        if (!$deleted){
            Session::flash('danger', 'ERROR deleted the File!');
            return Redirect::Back();
        }else{            
            Session::flash('success', 'Successfully deleted the File!');
            return Redirect::Back();
        }
    }
   /* public function inventory()
    {
        $recordPerPage      = 20;
        $data               = $this->data; 
        $data['title']      = "Manage Inventory";

        $data['products']     =  $this->inventoryTable->getAllInventoryByPage($recordPerPage);  
        return view(ADMIN_URL_PATH.'/product/inventory',$data);
    }
    
    
    public function inventoryupdate(Request $request)
    {
        if(!$request->ajax()){
            die('invalid request');
        }
        $id = $request->id;
        $newQuantity = $request->newQuantity;
        $result = $this->inventoryTable->updateInventory($id, $newQuantity); 
        return ($result) ? Response::json(array('status' => 1)) : Response::json(array('status' => 0));
    } */
    
    /* NEW INVENTORY MODULE */
    public function inventory(Request $request){
        $data = array();
        $products   =   Product::where('deleted','no');

        if($request->has('q')){
            $products = $products->where('id', $request->q)->orWhere('product_name','like', '%'.$request->q.'%');
        }

        $data['products']   =   $products->orderBy('quantity','asc')->where('deleted','no')->select('id','quantity','product_name')->paginate(10);

        return view(ADMIN_URL_PATH.'/product/inventory_new',$data);
    }

    public function updateInventory(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('productid')){
            exit;
        }

        if(!$request->has('updateQty')){
            return Response::json(array('message' => 'New Quantity value should not blank'));
        }

        $productid = $request->productid;
        $updateQty = $request->updateQty;

        $product   = Product::find($productid);

        if(!$product){
            return Response::json(array('message' => 'Product Does not exist'));
        }

        $product->quantity += $updateQty;

        if(!$product->save()){
            return Response::json(array('message' => 'Inventory not updated..'));
        }

        return Response::json(array('success'=> true,'message' => 'Inventory Updated Successfully', 'newQty' => $product->quantity));
    }

/* NEW INVENTORY MODULE ENDS */
    /*  Import and Export Inventory in Excel*/
    public function importExport(){
        return view(ADMIN_URL_PATH.'/product/importExport');
    }
    public function downloadExcel($type){
        //$result = $this->inventoryTable->getAllInventoryByPage();
        $result = Product::where('deleted','no')->get();
        $myresult           =   array();
        foreach( $result as $key => $myarr){
            $myresult[$key]['id']   =   $myarr->id;            
            $myresult[$key]['quantity']   =   $myarr->quantity;            
        }        
       $data = $myresult;
        //dd($myresult);
        return Excel::create('product_inventory', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        //dd($request->import_file);
        //$this->validate($request, ["import_file"  => "required| mimes:text,csv"]);
        $this->validate($request, ["import_file"  => "required"]);
        $file                       =   $request->file('import_file');
        $file_mime_type             =   $request->import_file->getMimeType();   
        if($file_mime_type!='text/plain'){
            $request->flash();
            Session::flash('incorrect_mime','The file should be an csv file');
            return Redirect::back();
            exit;
        }        
        if($request->hasFile('import_file')){
            $ext = pathinfo($request->file('import_file')->getClientOriginalName(), PATHINFO_EXTENSION);

            if(!in_array($ext, ['csv'])){
                Session::flash('incorrect_mime','The file should be an csv file');
                return Redirect::back();
                exit;
            }

            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {                
            })->get();             
            if(!empty($data) && $data->count()){                
                foreach ($data as $key => $value) {
                    //$where[] = (int)$value->id;
                    //$update[] = ['quantity' => (int)$value->quantity];
                    //DB::table('selected_varient_for_product')->where('id', (int)$value->id)->update(['quantity' => (int)$value->quantity]);
                    DB::table('product')->where('id',(int)$value->id)->update(['quantity' => (int)$value->quantity]);
                    //$update[] = "quantity => ".(int)$value->quantity;// ['quantity' => (int)$value->quantity];                   
                }
                //var_dump($update);
               //dd($where,$update);
                //DB::table('selected_varient_for_product')->whereIn('id', $where)->update($update);
               // DB::table('selected_varient_for_product')->whereIn('id', [72,73,74])->update();
            }
        }
        return Redirect::to('admin/product/inventory');
    }
    public function deleted(Request $request)
    {
        $data                   =   $this->data;
        $recoardPerpage         =   10;
        $products               =   DB::table('product')
        ->leftJoin('product_images','product_images.product_id','=','product.id')
        ->join('product_category','product_category.product_id','=','product.id');
        
        if($request->c && !is_null($request->c) && strlen($request->c)>0){
            $searchVar          =   $request->c;

            $categories         =   DB::table('category')->where('category','like','%'.$searchVar.'%')->select('id')->get();

            $searchCat          =   array();
            foreach ($categories as $category) {
                $searchCat[]    =   $category->id;
            }

            $searchProduct      =   DB::table('product_category')->whereIn('category_id',$searchCat)->groupBy('product_id')->select('product_id')->get();
            $searchPro          =   array();

            foreach ($searchProduct as $pro) {
                $searchPro[]    =   $pro->product_id;
            }

            $products           =   $products->where(function($query) use ($searchVar,$searchPro ){
                $query->where('product.product_name','like','%'.$searchVar.'%');
                $query->orWhereIn('product.id',$searchPro);
            });
        }
        
        $data['products']       =   $products->where('deleted','yes')->where('product_images.default_image', 'yes')
        ->select('product.id as upc','product_images.image as product_image','product.sku','product.product_mrp','product.product_selling_price','product.product_name','product.quantity')
        ->groupBy('product.id')
        ->paginate($recoardPerpage);

        //->toSql(); dd($data['products']);
        foreach ($data['products'] as $key => $product) {           
            $categories                                  =   DB::table('product_category')->where('product_id',$product->upc)->select('id','category_id')->get();
            $data['category'][$product->upc]                            =   '';
            foreach ($categories as $key => $category) {
                $categoryName                                     =    DB::table('category')->where('id',$category->category_id)->select('category')->first();
                $data['category'][$product->upc]                  .=    isset($categoryName->category)? $categoryName->category.',' : '';
            }
        }

        $data['current_page']   = $data['products']->currentPage();
        $data['index_items']    = ($recoardPerpage*$data['current_page'])-($recoardPerpage-1);
        return view('admin/product/deleted',$data);
    }
    public function restoreProduct(Request $request)
    {
        $product                            =   DB::table('product')->find($request->c);
        if(!$product){
            return redirect(ADMIN_URL_PATH.'/product');
            exit;
        }
        $product                      =   DB::table('product')->where('id',$request->c)->update(array('deleted' => 'no'));        
        return redirect()->back()->with(['success' => 'Product Restored Successfully.']); 
    }
    public function permanentDeleteProduct(Request $request, $id)
    {        
        $products = Product::where('id', $id)->where('deleted', 'yes')->first();
            //dd(!$products);
        if(!$products){
            return redirect()->back()->with(['danger'=> 'Product not found.']);
            exit;
        }
        $deleteProduct = Product::where('id', $id)->where('deleted', 'yes')->delete($id);   //Delete Product  
        if($deleteProduct){
            $pr_obj = new ProductHelper;
            $deleted = $pr_obj->productImageDelete($id);
            return redirect()->back()->with(['success' => 'Product Deleted Permanentally.']);     
        }else{
            return redirect()->back()->with(['danger'=> 'Something were wrong.']);
        }
        
    }
    public function placeImage($folder,$filename){
        $destination = public_path().'/'.$folder;
        $dim10                          =   '10x10';
        $dim20                          =   '20x20';
        $dim50                          =   '50x50';
        $dim100                         =   '100x100';
        $dim200                         =   '200x200';
        $dim300                         =   '300x300';
        $dim500                         =   '500x500';

        $image_url                      =   '';
            if(!file_exists($destination)){
                mkdir($destination);
            }

            if(!file_exists($destination.'/'.$dim10)){
                mkdir($destination.'/'.$dim10);
            }

            if(!file_exists($destination.'/'.$dim20)){
                mkdir($destination.'/'.$dim20);
            }

            if(!file_exists($destination.'/'.$dim50)){
                mkdir($destination.'/'.$dim50);
            }

            if(!file_exists($destination.'/'.$dim100)){
                mkdir($destination.'/'.$dim100);
            }

            if(!file_exists($destination.'/'.$dim200)){
                mkdir($destination.'/'.$dim200);
            }

            if(!file_exists($destination.'/'.$dim300)){
                mkdir($destination.'/'.$dim300);
            }

            
            if(!file_exists($destination.'/'.$dim500)){
                mkdir($destination.'/'.$dim500);
            }
            $uploaded                   =   $destination.'/'.$filename ;
            Image::make($uploaded)->resize(10, 10)->save($destination.'/'.$dim10.'/'.$filename);
            Image::make($uploaded)->resize(20, 20)->save($destination.'/'.$dim20.'/'.$filename);
            Image::make($uploaded)->resize(50, 50)->save($destination.'/'.$dim50.'/'.$filename);
            Image::make($uploaded)->resize(100, 100)->save($destination.'/'.$dim100.'/'.$filename);
            Image::make($uploaded)->resize(200, 200)->save($destination.'/'.$dim200.'/'.$filename);
            Image::make($uploaded)->resize(300, 300)->save($destination.'/'.$dim300.'/'.$filename);
            Image::make($uploaded)->resize(500, 500)->save($destination.'/'.$dim500.'/'.$filename);
    }

}