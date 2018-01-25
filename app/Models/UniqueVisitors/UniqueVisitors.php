<?php

namespace App\Models\UniqueVisitors;

use Illuminate\Database\Eloquent\Model;

class UniqueVisitors extends Model{
   
   	protected $table = 'total_unique_visitors_count';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'count',
		'date',
	);
	public $timestamps = false;
}
