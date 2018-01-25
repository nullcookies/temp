<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Model;

class BuyNow extends Model{
    
    protected $table = 'buy_now';
    protected $primary_key = 'id';
	protected $fillable = array(
        "billing_address",
        "billing_first_name",
        "billing_last_name",
        "billing_email",
        "billing_mobile",
        "billing_pincode",
        "billing_state",
        "billing_city",
        "billing_country",
        "billing_street_address",
        "shipping_address",
        "shipping_first_name",
        "shipping_last_name",
        "shipping_email",
        "shipping_mobile",
        "shipping_pincode",
        "shipping_state",
        "shipping_city",
        "shipping_country",
        "shipping_street_address",
        "payment_method",
        "selected_payment_method",
        "payment_info",
        "init",
        "shipping_price",
        "applied_coupon_code",
        "free_shipping",
        "coupon_code",
        "discount",
	);
	public $timestamps = false;	
}
