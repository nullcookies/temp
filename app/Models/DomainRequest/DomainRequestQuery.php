<?php

namespace App\Models\DomainRequest;

use Illuminate\Database\Eloquent\Model;

class DomainRequestQuery extends Model{
    
    protected $table = 'domain_request_query';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'domain_request_id',
		'query',
		'updated_at',
		'inserted_at',
		'user_id',
	);
	public $timestamps = true;
}
