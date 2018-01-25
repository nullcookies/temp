<?php

namespace App\Models\Orders;
use App\Models\Orders\Orders;
use Illuminate\Database\Eloquent\Model;
use DB,Auth,Session,Response,Redirect;

class Manifest extends Model
{
    protected $table = 'manifest';
    protected $primary_key = 'id';
	protected $fillable = ['id','oid','dispatchDate','reportGeneratedBy'];
	
	public function checkManifest($id) {
        $orderData = $this->getOrderById($id); 
        //dd($orderData->toArray());       
        $sendMail = 0;
        if (!empty($orderData)) {
            if ($orderData->status == 'open') {
                Orders::where('id',$id)->update(['status' => 'manifest']);
                $sendMail = 1;
            }
           
            
            $result = Manifest::where("oid",$id)->first(); 
            if (empty($result)) {
                Manifest::insertGetId(array(
            				'reportGeneratedBy'  =>  Auth::user()->name,
            				'oid' => $id));                
            }
            
            $select = Manifest::select(['manifest.id', 'manifest.oid', 'manifest.reportGeneratedBy', DB::raw("DATE_FORMAT(dispatchDate,'%b %d,%Y')" .'as dispatchDate' )]);
            $select->where("manifest.oid", $id);
            //dd($select->toSql());
            //$select->join("awb_number", "awb_number.oid", "=","manifest.oid");
            $manifestData = $select->first();
            return array('orders' => $orderData, 'manifest' => $manifestData, 'sendMail' => $sendMail);
        }
    }
    public function getOrderById($id) {
    	$orderObj = new Orders;
        $this->select = $orderObj->where('deleted','no');
        $this->select->select(array('*', DB::raw('CONCAT(shippingAddress,"<br>",shippingCity," ",shippingState," ",shippingPostCode) AS shippingCompleteAddress')));
        $this->select->where("orders.id", $id); 
               //dd($this->select->toSql());
        $orders = $this->select->first();
        $orders->products = DB::table('order_products')->where('order_id', $orders->id)->get();       
        return $orders;
    }
}
