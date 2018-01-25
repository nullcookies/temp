<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model{
    
    protected $table = 'notification';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'title',
		'content',
		'inserted_by',
		'type',
	);
	public $timestamps = true;
}
