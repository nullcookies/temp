<?php

namespace App\Models\UserLocation;

use Illuminate\Database\Eloquent\Model;

class State extends Model{
    
    protected $table = 'kiba_states';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'name',
		'country_id',
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getStatesByCountry($countries = array()){
		return self::whereIn('country_id', $countries)->get();
	}

	public static function getStateById($stateid){
		return self::where('id', $stateid)->first();
	}
}
