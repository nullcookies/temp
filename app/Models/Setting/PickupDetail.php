<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class PickupDetail extends Model{
    
    protected $table = 'user_pickup_detail';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'pickup_address',
		'pickup_pincode',
		'pickup_mobile',
		'pickup_email',
	);
	public $timestamps = false;	
}
