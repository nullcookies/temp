<?php

namespace App\Models\ProductCategory;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model{
    
    protected $table = 'product_category';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'product_id',
		'category_id',
	);
	public $timestamps = false;	
}
