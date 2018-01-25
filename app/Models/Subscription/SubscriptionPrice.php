<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPrice extends Model{
    
    public function __construct(){}

    protected $table = 'product_paytoorder';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'planid',
		'productid',
		'price',
		'slotid',
		'payamount',
	);
	public $timestamps = true;

	public static function getPrice($themeid, $planid, $timeslotid ){
		return self::where('planid',$planid)->where('slotid',$timeslotid)->first();
	}
}
