<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model{
    
    protected $table = 'subscriptions';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'txnid',
		'net_amount_debit',
		'payment_completed_at',
		'productinfo',
		'planid',
		'slotid',
		'equal_days',
		'firstname',
		'lastname',
		'address',
		'city',
		'state',
		'country',
		'zipcode',
		'email',
		'phone',
		'company_name',
		'tin_no',
		'tan_number',
		'inserted_at',
		'rm',
		'active_status',
	);
	public $timestamps = false;
}
