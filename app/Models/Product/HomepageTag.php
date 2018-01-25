<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class HomepageTag extends Model
{
    protected $table = 'homepage_tag';
    protected $primary_key = 'id';
	protected $fillable = ['id','tag','status'];
	public $timestamps = false;
}
