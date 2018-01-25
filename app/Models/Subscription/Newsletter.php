<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model{
    
    protected $table = 'newsletter';
    protected $primary_key = 'id';
	protected $fillable = ['id', 'email'];
	public $timestamps = true;
}
