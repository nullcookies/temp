<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model{
    
    protected $table = 'address';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'first_name',
		'last_name',
		'email',
		'mobile',
		'pincode',
		'state',
		'city',
		'country',
		'address',
		'user_id',
	);
	public $timestamps = false;
}
