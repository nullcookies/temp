<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model{
    
    protected $table = 'pincodes';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"zone_id",
        "pincode",
        "cod_available",
	);
	public $timestamps = false;	

	public function  __construct(){}

	public static function searchPincode($pincode){
		return self::where('pincode', $pincode)->first();
	}
}
