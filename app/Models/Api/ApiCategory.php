<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiCategory extends Model{
    
    protected $table = 'api_categories';
	protected $fillable = ['id', 'parentId','category'];	
	public $timestamps = false;	
}
