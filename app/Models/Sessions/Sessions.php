<?php

namespace App\Models\Sessions;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model{
    
    protected $table = 'sessions';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'user_id',
		'ip_address',
		'user_agent',
		'payload',
		'last_activity',
	);
	public $timestamps = true;	
}
