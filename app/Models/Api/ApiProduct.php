<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiProduct extends Model{
    
    protected $table = 'api_products';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"api_product_id",
        "imageUrl",
        "productTitle",
        "categoryId",
        "mrp",
        "retailPrice",
        "sellingPrice",
        "transfer_price",
        "margin",
        "final_visible_price",
        "final_paid_price",
        "description", 
        "committedQuantity",
        "cod",
        "weight",
        "freeShipping",
        "product_images",
	);
	public $timestamps = false;	
}
