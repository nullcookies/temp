<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    protected $primary_key = 'id';
	protected $fillable = ['id','name','alias','content','status','craeted_by'];
	public $timestamps = true;
}
