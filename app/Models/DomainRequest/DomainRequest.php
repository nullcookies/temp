<?php

namespace App\Models\DomainRequest;

use Illuminate\Database\Eloquent\Model;

class DomainRequest extends Model{
    protected $table = 'domain_request';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'domain_name',
		'service_provider',
		'user_name',
		'password',
		'status',
		'updated_at',
		'inserted_at',
	);
	public $timestamps = true;
}

