<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Model;

class AssignedCoupon extends Model{
    
    protected $table = 'assigned_coupons';
    protected $primary_key = 'id';
	protected $fillable = array(
        "email",
        "coupon_id",
	);
	public $timestamps = false;	
}
