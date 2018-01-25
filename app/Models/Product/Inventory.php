<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use DB,Auth,Session,Response,Redirect;
use App\Models\Product\Product;
use Carbon\Carbon;
class Inventory extends Model
{
	protected $table = 'selected_varient_for_product';
	protected $filable = ['id', 'product_id', 'varient_type_id', 'varient_type_value_id', 'quantity'];

    public function getAllInventoryByPage($recordPerPage='') {
		$this->select = DB::table($this->table.' AS t1');
		$this->select->join("varient_type_values AS t2", "t1.varient_type_value_id", "=", "t2.id");
		$this->select->join("product AS t3", "t1.product_id", "=", "t3.id");
		$this->select->select(['t1.*',  't3.product_name AS product', 't3.quantity AS committedQuantity', 't2.value AS varient']);
		//$this->select = $inventoryObj;//->where('quantity', '!=','');
        //dd($this->select->toSql());
        if(!empty($recordPerPage)){
        	return $this->select->paginate($recordPerPage);
        }
        return $this->select->get();
        
    }
	public function updateInventory($id, $newQuantity) {       
        $result = DB::table($this->table)->where('id', $id)->update(array('quantity' => $newQuantity));
        return array('status' => $result);        
    }
    
}
