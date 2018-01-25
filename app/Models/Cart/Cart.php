<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model{
    
    protected $table = 'cart';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'product_id',
		'quantity',
		'product_type',
	);
	public $timestamps = false;	

	public static function fetchUserCart(){
		return 'TD';
	}
}
