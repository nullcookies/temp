<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharges extends Model{
    
    protected $table = 'delivery_charges';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"zone_id",
        "delivery_weight_id",
        "price",
	);
	public $timestamps = false;	
}
