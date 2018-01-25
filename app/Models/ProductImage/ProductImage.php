<?php

namespace App\Models\ProductImage;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model{
    
    protected $table = 'product_images';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'image',
		'default_image',
		'product_id',
	);
	public $timestamps = false;	
}
