<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model{
    
    protected $table = 'coupons';
    protected $primary_key = 'id';
	protected $fillable = array(
        "coupon_name",
        "coupon_code",
        "coupon_type",
        "discount",
        "minimum_order_amt",
        "minimum_order_amt_type",
        "free_shipping",
        "date_start",
        "date_end",
        "per_coupon_limit",
        "per_user_limit",
        "to_customer_type",
        "description",
        "status",
        "deleted",
	);
	public $timestamps = false;	
}
