<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCommission extends Model
{
    protected $table = 'selected_commission_category_price';
    protected $primary_key = 'id';
	protected $fillable = ['id','category_id', 'price'];
	public $timestamps = false;
}
