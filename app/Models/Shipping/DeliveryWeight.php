<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class DeliveryWeight extends Model{
    
    protected $table = 'delivery_weight';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"weight",
        "weight_in_gms",
	);
	public $timestamps = false;	

	public function __construct(){}

	public static function getWeightDomain($product_weight){
		$data 		=	array();
		if(!self::all()){
			return false;
			exit;
		}

		$check 		=  -1;
		foreach(self::all() as $weight){
			if(intval($weight->weight_in_gms) - $product_weight >= 0){
				$data['id'] 	=	$weight->id;
				$data['weight']	=	$weight->weight;
				break;
			}
		}

		return $data;

	}
}
