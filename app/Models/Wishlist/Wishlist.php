<?php

namespace App\Models\Wishlist;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model{
    
    protected $table = 'wishlist';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'product_id',
	);
	public $timestamps = false;	
}
