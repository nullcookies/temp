<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model{
    
    public function __construct(){}

    protected $table = 'order_products';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
        "product_id",
		"orders_id",
        "product_name",
        "product_description",
        "varients",
        "selling_price",
        "mrp",
        "product_weight",
        "quantity",
        "product_type",
	);
	public $timestamps = false;	
}
