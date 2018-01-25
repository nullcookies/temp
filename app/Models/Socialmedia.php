<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model{
    
    protected $table = 'socialmedia';
    protected $primary_key = 'id';
	protected $fillable = ['id','name', 'slug', 'link'];
	public $timestamps = true;
}
