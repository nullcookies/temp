<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    
    protected $table = 'product';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'product_name',
		'product_description',
		'brand',
		'weight',
		'dimensions',
		'substract_stock',
		'sku',
		'model',
		'product_mrp',
		'product_selling_price',
		'quantity',
		'meta_title',
		'meta_description',
		'meta_keywords',
		'product_tags',
		'product_upc',
		'isbn',
		'asin',
		'ean',
		'requires_shipping',
		'maximum_order_quantity',
		'minimum_order_quantity',
		'deleted',
	);
	public $timestamps = false;	
	
	public function combos()		{
		return $this->hasMany('App\Combo', 'product_id');
	}
}
