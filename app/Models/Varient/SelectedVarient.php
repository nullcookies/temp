<?php

namespace App\Models\Varient;

use Illuminate\Database\Eloquent\Model;

class SelectedVarient extends Model{
    
    protected $table = 'selected_varient_for_product';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'product_id',
		'varient_type_id',
		'varient_type_value_id',
	);
	public $timestamps = false;
	public function product_varient_type($productid=null)
	{
		$result = SelectedVarient::join('varient_types', 'selected_varient_for_product.varient_type_id', '=', 'varient_types.id')
					->groupBy('selected_varient_for_product.varient_type_id')					
					->select(['varient_types.id','varient_types.varient_type']);
		if($productid != null){
			$result->where('selected_varient_for_product.product_id', $productid);
		}							
		return $result->get();
	}	
	public function product_varient_type_value($productid=null)
	{
		$data = array();
		$result = SelectedVarient::join('varient_type_values', 'selected_varient_for_product.varient_type_value_id', '=', 'varient_type_values.id')
					->join('varient_types','varient_types.id','=','selected_varient_for_product.varient_type_id')
					/*->where('selected_varient_for_product.varient_type_id',$id)*/
					->select(['varient_type_values.id','varient_type_values.value','varient_types.id as varient_type_id'])
					->groupBy('selected_varient_for_product.varient_type_value_id');
		if($productid != null){
			$result->where('selected_varient_for_product.product_id', $productid);
		}
		return $result->get();	
	}

}
