<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model{
    
    protected $table = 'user_business_detail';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'company_legal_name',
		'city_registered',
		'type',
		'address',
		'tin',
		'pan'
	);
	public $timestamps = false;	
}
