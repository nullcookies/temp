<?php

namespace App\Models\OrderReturn;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model{
    
    protected $table = 'return_request';
    protected $primary_key = 'id';
	protected $fillable = array(
		"id",
		"oid",
        "status",
        "comment",
        "recordInsertedDate"
	);
	public $timestamps = false;	
}
