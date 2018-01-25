<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use DB,Auth,Session,Response,Redirect;
use App\Models\Product\Product;
use Carbon\Carbon;

class Orders extends Model
{
	protected $table = 'orders';
	protected $primary_key = 'id';
	protected $fillable = [
		'id',		
		'customerName',
		'customerPhone',
		'customerEmail',
		'customerAddress',
		'customerCity',
		'customerPostCode',
		'customerState',
		'shippingName',
		'shippingEmail',
		'shippingPhone',
		'shippingAddress',
		'shippingCity',
		'shippingState',
		'shippingPostCode',		
		'status',
		'userId',
		'orderAmount',			
		'shippingCharge',
		'paymentType',
		'signedManifest',
		'txnId',
		'paymentData',
		'returnComment',
		'returnStatus',		
		'created_at',
		'updated_at',
		'seller_id',
		'payu_trans',
		'payu_status',
		'payu_txnid',
		'payu_amount',
		'delivery_charge',		
		'cod_charges',
		'apply_coupen_id',
		'apply_coupon',
		'coupon_amount_type',
		'coupon_amount',
		'officeaddress',
		'opentime',
		'closetime',
		'landline',		
        'products'
	];
	public $timestamps = true;	

    public function products(){
        return $this->hasMany('App\Models\Orders\OrderProducts','order_id');
    }
	   
	public function manifest(){
        return $this->hasOne('App\Models\Orders\Manifest','oid');
    }
	
	public function returnOrder(){
        return $this->hasOne('App\Models\OrderReturn\ReturnRequest','oid');
    }
	
	public function shippingCompleteAddress()
	{
		return $this->shippingAddress .'<br/>'. $this->shippingCity .' '.$this->shippingState.' '.$this->shippingPostCode.'<br/>Mob: '.$this->customerPhone;
	}
	public function getState($countyid)
	{
		if($countyid > 0){
			$result = DB::table('kiba_states')->where('country_id',$countyid)->get();
			return $result;
		}
	}
	public function getCity($stateid)
	{
		if($stateid > 0){
			$result = DB::table('kiba_cities')->where('state_id',$stateid)->get(); 			
			return $result;
		}
	}
	public function stateName($id)		
	{
		$result = DB::table('kiba_states')->where('id',$id)->first();
		return $result->name;
	}
	public function cityName($id)		
	{
		$result = DB::table('kiba_cities')->where('id',$id)->first();
		return $result->name;
	}
	public function varientValue($varientid)	
	{
		$query = DB::table('varient_type_values')->whereIn('id',$varientid)->get();
		foreach ($query as $key => $value) {
			$result[] = $value->value;
		}		
		return implode(',', $result);
	}
	public function InsertData($param)
	{
		$varient_id = implode(',', $param->varientTypeValue); 
		if(count($param) > 0){			 
			$this->customerName 	= $param->customerName;
			$this->customerPhone 	= $param->customerPhone;
			$this->customerEmail 	= $param->customerEmail;
			$this->customerAddress 	= $param->customerAddress;
			$this->customerCity 	= $this->cityName($param->customerCity);
			$this->customerPostCode = $param->customerPostCode;
			$this->customerState 	= $this->stateName($param->customerState);
			$this->orderAmount 		= $param->price;			
			$this->paymentType		= $param->paymentType;	

            if(!empty($param->setbillingaddress)){
                $this->shippingName     = $param->customerName;
                $this->shippingPhone    = $param->customerPhone;
                $this->shippingEmail    = $param->customerEmail;
                $this->shippingAddress  = $param->customerAddress;
                $this->shippingCity     = $this->cityName($param->customerCity);
                $this->shippingPostCode = $param->customerPostCode;
                $this->shippingState    = $this->stateName($param->customerState);
            }	               
			$this->save();
            DB::table('order_products')->insertGetId([
                'order_id'          => $this->id,
                'product_id'        => $param->productCode,
                'product_name'      => $param->productName,
                'product_description' => '',
                'varients'          => $varient_id,
                'selling_price'     => $param->productAmount,
                'mrp'               => $param->mrp,
                'product_weight'    => $param->weight,
                'quantity'          => $param->quantity,
                'product_type'      => 'normal',
            ]);
			return $this->id;
		}
	}
	public function getproduct()
	{
		return Product::where('deleted','no')->select(['id','product_name'])->get();		 				        
	}
	public function setProductData($id)
	{
		return Product::where('id',$id)->select(['id','product_name', 'product_selling_price','weight', 'product_description', 'sku', 'product_mrp', 'quantity'])->first();
	}
	public function getOrderData($id)
	{
		$result = Orders::find($id);
		$dd = DB::table('kiba_states')->where('name', $result->customerState)->select('id')->first();
		$result['stateid'] = $dd->id;
		$dd = DB::table('kiba_cities')->where('name', $result->customerCity)->select('id')->first();
		$result['cityid']  = $dd->id;
        $result['ordersProduct']   = DB::table('order_products')->where('order_id', $id)->select(['id', 'product_id', 'product_name'])->get();
		return $result;
	}	
    
    public function getOrderByIdForShippingLabel($id) {
    	$orderObj = new Orders;
    	$this->select = $orderObj->where('deleted','no');
    	$this->select->select(array('*', DB::raw('CONCAT(shippingAddress,"<br>",shippingCity," ",shippingState," ",shippingPostCode) AS shippingCompleteAddress')));
    	$this->select->where("orders.id", $id);          
    	$orders = $this->select->first();
        $orders->products = DB::table('order_products')->where('order_id', $orders->id)->get();       
        return $orders;
    }
	   
    public function getReturnsByPage($filter) { 
    	$orderObj = new Orders;
    	$this->select = $orderObj->where('deleted','no');
    	$this->select->select(array('return_request.*', DB::raw('DATE_FORMAT(return_request.recordInsertedDate,"%b %d,%Y") AS date'),'orders.customerName'));
    	$this->select->where("return_request.status","$filter");
    	$this->select->leftJoin('return_request', "return_request.oid",'=',"orders.id");

    	$this->select->orderBy("return_request.id","DESC");       
        //dd($this->select->toSql(), $filter);
    	return $this->select->paginate(10);
    }
    public function changeStatus($id, $status, $oid) {
    	DB::table('return_request')->where('id', $id)->update(['status' => $status]);
    	if ($status == 'approve') {            
    		Orders::where('id', $oid)->update(['status' => 'return']);
    	}
    	return array('status' => 1);
    }
    public function getOrderByStatus($filter,$keyword)
    {
    	$orderObj = new Orders;
    	$this->select = $orderObj->where('deleted','no');
    	
    	if ($filter == 'today') {
            $this->select->where("$this->orderTable.status", 'open');
            $this->select->where("$this->orderTable.created_at", ">", DB::raw("DATE_SUB(NOW(), INTERVAL 24 HOUR)"));
            $fillwith = 'open';
        } else if ($filter == 'delayed') {
            $this->select->where("$this->orderTable.status", 'open');
            $this->select->where("$this->orderTable.created_at", "<", DB::raw("DATE_SUB(NOW(), INTERVAL 24 HOUR)"));
             $fillwith = 'open';
        }else if ($filter == 'manifest') {
            $this->select->where("$this->orderTable.status", 'manifest');	 $fillwith = 'manifest';
        } else if ($filter == 'shipped') {	
            $this->select->where("$this->orderTable.status", 'shipped');	 $fillwith = 'shipped';
        } else if ($filter == 'delivered') {
            $this->select->where("$this->orderTable.status", 'delivered');	 $fillwith = 'delivered';
        } else if ($filter == 'completed') {
            $this->select->where("$this->orderTable.status", 'completed');	 $fillwith = 'completed';
        } else if ($filter == 'return') {
            $this->select->where("$this->orderTable.status", 'return');		 $fillwith = 'return';
        } else if ($filter == 'cancel') {
            $this->select->where("$this->orderTable.status", 'cancel'); 	 $fillwith = 'cancel';
        } else if ($filter == 'open') {
            $this->select->where("$this->orderTable.status", 'open');		 $fillwith = 'open';
        }else if($filter == 'manifested')          {
            $this->select->whereNotIn("$this->orderTable.status", ['open','cancel']);    $fillwith = 'manifest';
        }else if($filter == 'dispatched'){
            $this->select->whereNotIn("$this->orderTable.status", ['open','cancel','manifest']);    $fillwith = 'dispatch';
        }
        if(!empty($keyword))
        {
            if($fillwith == 'dispatch')  {
                $this->select->whereNotIn("$this->orderTable.status", ['open','cancel','manifest']); 
            }   else{
                $this->select->where("$this->orderTable.status", $fillwith);
            }   
        	
            $this->select->where("orders.id",$keyword);
            $this->select->orWhere("orders.customerPhone",$keyword);            
        }
        $this->select->orderBy("orders.id","DESC");       
        //dd($this->select->toSql(),$fillwith,$filter); 
        $orders = $this->select->paginate(10);        
        foreach ($orders as $key => $value) {
            $orders[$key]['products'] = DB::table('order_products')->where('order_id', $value->id)->get();
        }

        //dd($orders,$filter);
    	return ['orders' => $orders];
    }
    public function getOrderByPage($filter, $keyword) {
        $orderObj = new Orders;
        $this->select = $orderObj->where('deleted','no'); 
        if ($filter == 'today') {
            $this->select->where("$this->orderTable.status", 'open');
            $this->select->where("$this->orderTable.created_at", ">", DB::raw("DATE_SUB(NOW(), INTERVAL 24 HOUR)"));
            $fillwith = 'open';
        } else if ($filter == 'delayed') {
            $this->select->where("$this->orderTable.status", 'open');
            $this->select->where("$this->orderTable.created_at", "<", DB::raw("DATE_SUB(NOW(), INTERVAL 24 HOUR)"));
             $fillwith = 'open';
        }else if ($filter == 'manifest') {
            $this->select->where("$this->orderTable.status", 'manifest');	 $fillwith = 'manifest';
        } else if ($filter == 'shipped') {	
            $this->select->where("$this->orderTable.status", 'shipped');	 $fillwith = 'shipped';
        } else if ($filter == 'delivered') {
            $this->select->where("$this->orderTable.status", 'delivered');	 $fillwith = 'delivered';
        } else if ($filter == 'completed') {
            $this->select->where("$this->orderTable.status", 'completed');	 $fillwith = 'completed';
        } else if ($filter == 'return') {
            $this->select->where("$this->orderTable.status", 'return');		 $fillwith = 'return';
        } else if ($filter == 'cancel') {
            $this->select->where("$this->orderTable.status", 'cancel'); 	 $fillwith = 'cancel';
        } else if ($filter == 'open') {
            $this->select->where("$this->orderTable.status", 'open');		 $fillwith = 'open';
        }     

        if(!empty($keyword) && !is_array($keyword))
        {
        	$this->select->where("$this->orderTable.status", $fillwith);
            $this->select->where("orders.id",$keyword);
            $this->select->orWhere("orders.customerPhone",$keyword);            
        }
        if(is_array($keyword)){
            if(isset($keyword['key']) && !empty($keyword['option'])>0){
                $this->select->where($keyword['option'],'like','%'.$keyword['key'].'%');
            } 
            if(isset($keyword['start_date']) && strlen($keyword['start_date'])>0 && strtotime($keyword['start_date']) ){
                $start_date             = date('Y-m-d', strtotime($keyword['start_date']));
                $this->select->Where('created_at','like',$start_date."%");
            }
        }
        //dd($keyword,$this->select->toSql());
        $this->select->orderBy("orders.id","DESC");
        //dd($filter, $keyword,$this->select->toSql(),$start_date);
        $orders = $this->select->paginate(10);       
        foreach ($orders as $key => $value) {
            $orders[$key]['products'] = DB::table('order_products')->where('order_id', $value->id)->get();
        }
        return ['orders' => $orders];
    }
    public function updateStatus($id,$status) {
        $result = Orders::where('id', $id)->update(['status' => $status]);
        return $result;
    }    
    public static function getVarientByIds($ids){    
        $ids_array = explode(',', $ids);
        $result = DB::table('varient_type_values')->whereIn('id', $ids_array)->get();
        //dd($ids);
        $var  = array();
        if(count($result)){
            foreach ($result as $key => $value) {
                array_push($var, $value->value);
            }
            return implode(',', $var);
        }else{
            return '';
        }         
    }
}
