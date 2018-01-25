<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Model;

class BuyNowProducts extends Model{
    
    protected $table = 'buy_now_products';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"upc",
        "product_name",
        "product_description",
        "product_mrp",
        "product_selling_price",
        "varients",
        "product_from",
        "quantity",
        "buy_now_id",
        "weight",
	);
	public $timestamps = false;	
}
