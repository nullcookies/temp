<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model{
    
    protected $table = 'user_bank_detail';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'account_number',
		'type',
		'bank_name',
		'ifsc_code',
	);
	public $timestamps = false;
}
