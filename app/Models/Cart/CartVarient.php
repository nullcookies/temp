<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class CartVarient extends Model{
    
    protected $table = 'cart_varients';
	protected $fillable = array(
		'cart_id',
		'varient_type_id',
		'varient_type_value_id',
	);
	public $timestamps = false;	
}
