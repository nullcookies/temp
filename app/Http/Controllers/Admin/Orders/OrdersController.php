<?php

namespace App\Http\Controllers\Admin\Orders;
use App\Models\Orders\AwbNumber;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Models\Orders\Orders;
use App\Models\Orders\Manifest;
use App\Http\Controllers\Controller;
use DB,Auth,Session,Response,Redirect,Image;
use Carbon\Carbon;
use App\Http\Requests\Admin\Orders\OrderRequest;
use App\Models\Varient\SelectedVarient;
class OrdersController extends Controller
{
	private $orderobj;
    private $selected_varient;
    public function __construct(Orders $order, SelectedVarient $selected_varient,Manifest $manifest){   
    	$this->orderobj             = $order;
    	$this->selected_varient     = $selected_varient;
        $this->manifest             = $manifest;

    }
    public function index(Request $request)
    {
        $searchKeyword = '';      
        $filter                 = isset($request->status) ? $request->status : 'all';
        if (isset($request->key) && isset($request->opt) || isset($request->start_date)) {
            $searchKeyword      = ['key' => $request->key, 'option' => $request->opt, 'start_date' => $request->start_date];
        }
        $data                       = $this->orderobj->getOrderByPage($filter, $searchKeyword);
        $data['title']              = "Order List";
        $data['status']             = ['all'=>'All','today' => 'Fulfilled Today','delayed' => 'Delayed','manifest' => 'Manifested','shipped' => 'Shipped','delivered' => 'Delivered','completed' => 'Completed','return' => 'Returns',
                                     'cancel' => 'Cancel'];
        $data['opt']                = ($request->opt) ? $request->opt : '';        
       return view('admin/orders/index', $data);
   }
   /*Add Order by Admin*/
   public function create(Request $request)
   {
        $data                   = array();
        $data['title']          = 'Add Order';  
        $data['states']      	= $this->orderobj->getState(101);// id 101 for India in Countries Table
        $data['products']		= $this->orderobj->getproduct();
        $data['varientTypes']	= $varientTypes = $this->selected_varient->product_varient_type();       
        return view('admin/orders/admin-order',$data);
    }
    // Post Order
    public function postOrder(OrderRequest $request)
    {
    	//dd($request->all());
    	$saveOrder = $this->orderobj->InsertData($request);
    	if(!$saveOrder){
            Session::flash('danger','Data Cant saved');
            return Redirect::back();
        }
        Session::flash('success','Order Successfully Saved. Order ID: '.$saveOrder);
        return redirect(ADMIN_URL_PATH.'/orders/addproduct/'.$saveOrder);
    }
    public function setProductData(Request $request)
    {    	
    	$data['product']           = $this->orderobj->setProductData($request->id);
        $data['varientTypes']      = $varientTypes = $this->selected_varient->product_varient_type($request->id);        
        $data['varients']          = $this->selected_varient->product_varient_type_value($request->id);         
        //dd($data['varients']);
        return $data;
    }
    public function addproduct($id)
    {
        $data                   = array();
        $countryCode            = 101;
        $data['title']          = 'Add More Product';
        $data['states']         = $this->orderobj->getState($countryCode);// id 101 for India in Countries Table
        $data['products']       = $this->orderobj->getproduct();
        $data['varientTypes']   = $varientTypes = $this->selected_varient->product_varient_type(); 
        $data['order']          = $this->orderobj->getOrderData($id);
        $data['status']         = ['open','manifiest','shipped','delivered','Completed','return'];
        return view(ADMIN_URL_PATH.'/orders/addproduct',$data);
    }
    public function updateProduct(Request $request)
    {
        $varient_id = implode(',', $request->varientTypeValue);      
        $products = DB::table('order_products')->insertGetId([
            'order_id'          => $request->orderid,
            'product_id'        => $request->productCode,
            'product_name'      => $request->productName,
            'product_description' => '',
            'varients'          => $varient_id,
            'selling_price'     => $request->productAmount,
            'mrp'               => $request->mrp,
            'product_weight'    => $request->weight,
            'quantity'          => $request->quantity,
            'product_type'      => 'normal',            
            ]);
        
        if(!$products){
            Session::flash('danger','Data Can\'t saved or no update');
            return Redirect::back();
        }

        Session::flash('success','Product Added in Order ID '.$request->orderid);         
        return redirect(ADMIN_URL_PATH.'/orders/addproduct/'.$request->orderid);
    }
    /* Delete Order*/
    public function deleteorder(Request $request)
    {  
        $id = $request->id;
        $deleteQuery = Orders::find($id)->delete();        
        if($deleteQuery)
        {            
            Session::flash('class', "danger");
            Session::flash('deleted', "Order Deleted Successfully.");
            return Redirect::back();
        }
        else
        {
            Session::flash('class', "danger");
            Session::flash('someerror', "Due to some error the item is not removed from system.. Try again !!");
            return Redirect::back();
        }        
    }
    public function ajaxShowCity(Request $request)
    {
    	$data                   = array();
    	$data['results']      	= $this->orderobj->getCity($request->stateid); // id 101 for India in Countries Table
        foreach($data['results'] as $result){
            $selected = ($request->cityid == $result->id) ? "selected" : '';
            echo "<option value=".$result->id." ".$selected.">".$result->name."</option>";
        }	
    }
    public function manifest(Request $request)
    {       
        $filter                 = isset($request->s) ? $request->s : 'today';
        $searchKeyword          = isset($request->search) ? $request->search : '';
        $data                   = $this->orderobj->getOrderByStatus($filter, $searchKeyword);        
        $data['title']          = 'Generate Manifest';
        //dd($data);
        return view(ADMIN_URL_PATH.'/orders/manifest', $data);
    }    

    public function manifestlabel($id)
    {
        $data = array();
        $data = $this->manifest->checkManifest($id); 
        return view(ADMIN_URL_PATH.'/orders/manifestlabel', $data);
    }
    /*public function shippinglabel($id)
    {
        $data['title'] = 'Techturtle.in';
        $data['shippedBy'] = 'Digi Delivery';
        $data['orders'] = $this->orderobj->getOrderByIdForShippingLabel($id);        
        return view(ADMIN_URL_PATH.'/orders/shippinglabel', $data);
    }*/
    
    
    public function shippinglabel($id)
    {
        $data['title'] = 'Techturtle.in';
        $data['shippedBy'] = 'Digi Delivery';
        $awbNumber = AwbNumber::where('used','no')->first();

        if(!$awbNumber){
            echo 'please update AWB numbers'; exit;
        }

        $order     = Orders::find($id);
        
        if($order->shipping_label_printed == 'no'){
            $order->shipping_label_printed = 'yes';
        }
        
        if($order->saved_awb_number == 'no'){
            $order->awb_number  = $awbNumber->awb_number;
            $order->saved_awb_number = 'yes';
            $awbNumber->used = 'yes';
        }

        if($order->save()){
            $awbNumber->save();
        }
        $data['website_name'] = strlen(Auth::user()->website_name) ? Auth::user()->website_name : 'techturtle';
        $data['orders'] = $this->orderobj->getOrderByIdForShippingLabel($id);        
        return view(ADMIN_URL_PATH.'/orders/shippinglabel', $data);
    }
    
    public function orderRreturn(Request $request)
    {        
        $data                   = array();  
        $data['title']          = 'Order Return Request'; 
        $filter                 = isset($request->s) ? $request->s : 'open';       
        $data['orders']         = $this->orderobj->getReturnsByPage($filter);          
        return view(ADMIN_URL_PATH.'/orders/return', $data);         
    }
    public function updateStatus(Request $request)
    {
        $data                   = array();  
        $data['title']          = 'Order Return Request'; 
        if($request->ajax()){
            $id                     = (int) $request->id;
            $status                 = $request->status;
            $oid                    = (int) $request->oid;      

            $result                 = $this->orderobj->changeStatus($id, $status, $oid);        
            return Response::json([
                'success' => true,
                'data'   => $result
                ]);  
        }            
    }
    public function orderDispatch(Request $request)
    {  
        $filter                 = isset($request->s) ? $request->s : 'manifest';
        $searchKeyword          = isset($request->search) ? $request->search : '';
        $data                   = $this->orderobj->getOrderByStatus($filter, $searchKeyword);
        $data['title']          = 'Dispatch Order'; 

        return view(ADMIN_URL_PATH.'/orders/dispatch', $data);         
    }
    public function signedmanifest($id)
    {
        $data                   = array();           
        $data                   = $this->manifest->checkManifest($id);
        $data['title']          = 'Upload Signed Manifest';
        if(!$data){
            return \Redirect::back();
        } 
        return view(ADMIN_URL_PATH.'/orders/signedmanifest', $data);  
    }
    public function postsignedmanifest(Request $request)
    {
        /*if(!isset($request->signedManifest)){
            return Redirect::back();        
        }*/
        $this->validate($request, [
            "signedManifest"  => "required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048",            
            ]);
        $imageName = time().'-manifest-.'.$request->signedManifest->getClientOriginalExtension();
        $request->signedManifest->move(public_path('product_images'), $imageName);
        if(!empty($request->oldscr) && is_file(public_path('product_images/').$request->oldscr)){
            unlink(public_path('product_images/').$request->oldscr);
        }
        Orders::where('id',$request->oid)->update(['status' => 'shipped','signedManifest' => $imageName, 'is_dispatched' => 'yes', 'dispatched_time' => Carbon::now() ]);

        return redirect('admin/orders/orderDispatch')
        ->with('success','Image Uploaded successfully.');    

    }
    public function orderShipped(Request $request)
    {        
        $filter                 = isset($request->s) ? $request->s : 'shipped';       
        $searchKeyword          = isset($request->search) ? $request->search : '';
        $data                   = $this->orderobj->getOrderByStatus($filter, $searchKeyword); 
        $data['title']          = 'Mark Delivered';                 
        return view(ADMIN_URL_PATH.'/orders/shipped', $data);         
    }    
    public function orderDelivered(Request $request)
    {        
        $filter                 = isset($request->s) ? $request->s : 'delivered';       
        $data                   = $this->orderobj->getOrderByPage($filter,$request->search,10);   
        $data['title']          = 'Mark Completed'; 
              
        return view(ADMIN_URL_PATH.'/orders/delivered', $data);         
    }    
    public function orderReturn(Request $request)
    {        
        $filter                 = isset($request->s) ? $request->s : 'delivered';       
        $data                   = $this->orderobj->getOrderByPage($filter,$request->search,10);   
        $data['title']          = 'Mark Return'; 
              
        return view(ADMIN_URL_PATH.'/orders/returnorders', $data);         
    }
    public function ajaxUpdate(Request $request)
    {        
        if(!$request->ajax()){
            die("Bad Request");
        }
        $result = $this->orderobj->updateStatus($request->id,$request->status);
        if($result)        {
            if($request->status == 'return'){
                DB::table('return_request')->insertGetId([
                    'oid' => $request->id,
                    'status' => 'open',
                    'comment' => 'return by admin : '.Auth::user()->name . "(".Auth::user()->id.")",
                    'recordInsertedDate' => Carbon::now(),
                    ]);
            }
            
            if($request->status == 'delivered'){
                DB::table('orders')->where('id', $request->id)->where('is_dispatched','yes')->update(array('is_delivered' => 'yes','delivery_time' => Carbon::now()));
            }

            if($request->status == 'completed'){
                DB::table('orders')->where('id', $request->id)->where('is_dispatched','yes')->update(array('is_completed' => 'yes','order_complete_time' => Carbon::now()));
            }
            
            return Response::json(['success' => 'Update record successfully.', 'result' => $result]);
        }        
    }
    public function ajaxProductVarientPrice(Request $request)
    {
        if(!$reuest->ajax()){
            die('Bad Request');
        }
        $data['product_varient']   = DB::table('product_varient_price')->find($request->id);
        //dd($data['product_varient']);
        return $data;
    }
    
    /* new appended */

    public function saveBulkMenifest(Request $request){

        if(!$request->has('orderid')){
            return Redirect::back();
        }
        
        if(!is_array($request->orderid)){
            return Redirect::back();
        }

        if($request->has('alreadyManifested')){
            $ids = implode(',', $request->orderid);
            return redirect('admin/orders/bulkMenifest?data='.$ids);exit;
        }

        $orders  = Orders::where('shipping_label_printed','yes')->whereIn('status',['open'])->whereIn('id', $request->orderid)->select('id','status')->get();
        
        $menifestedOrderIds = array();
        $manifestArr        = array();
        foreach($orders as $order){
            $menifestedOrderIds[] = $order['id'];
            $manifestArr[] = array('oid' => $order['id'], 'reportGeneratedBy' => Auth::user()->id);
        }

        $updateStatus   = DB::table('orders')->whereIn('id', $menifestedOrderIds)->update(array('status' => 'manifest'));
            
        $ids = '';
        if($updateStatus){
            Manifest::insert($manifestArr);
            $ids = implode(',', $menifestedOrderIds);
        }
        
        return redirect('admin/orders/bulkMenifest?data='.$ids);
    }

    public function showBulkMenifest(Request $request){
        if(!$request->has('data')){
            echo 'no data available to print manifest'; die;
        }

        $orderids   = explode(',', $request->data);
        $orders     = Orders::join('manifest','manifest.oid','=','orders.id')->whereIn('manifest.oid',$orderids)->select('orders.*','manifest.id as manifestid','manifest.reportGeneratedBy')->get();

        $websiteName  = strlen(Auth::user()->website_name) ? Auth::user()->website_name : 'techturtle';
        return view('admin/orders/bulkmenifest',array('orders' => $orders,'date' => Carbon::now()->format('D d-M-Y | h:i:s'), 'website_name' => $websiteName));
    }
    
    public function trackOrder($orderid){
        $data = array();
        $data['title'] = 'Track Order';
        $data['order'] = Orders::find($orderid);
         $commission_Payment = DB::table('commision_ref_table')->whereIn('orders_ids',[$orderid])->first();
        $data['payment_status'] = $commission_Payment ? 'Remmited' : 'Pending';
        $data['commission_earned'] = $commission_Payment ?$commission_Payment->commision_amount:0;
        return view('admin/orders/trackorder', $data);
    }
    
    public function trackOrderRequest(Request $request){
        if(!$request->has('oid')){
            return Redirect::back(); exit;
        }

        $data = array();
        $data['title'] = 'Track Order';
        $data['order'] = Orders::find($request->oid);
        $commission_Payment = DB::table('commision_ref_table')->whereIn('orders_ids',[$request->oid])->first();
        $data['payment_status'] = $commission_Payment ? 'Remmited' : 'Pending';
        $data['commission_earned'] = $commission_Payment ?$commission_Payment->commision_amount:0;
        return view('admin/orders/trackorder', $data);
    }
    
    public function getInvoice(Request $request, $orderid){
        $data = array();

        $data['order'] = Orders::find($orderid);

        $data['user']  = User::leftJoin('trials','trials.user_id','=','users.id')->select('users.*','trials.subdomain')->first();
        if(!$data['order']){
            return Redirect::back();
        }

        //dd($data);
        return view('admin/orders/invoice', $data);
    }
}
