<?php

namespace App\Models\UserLocation;

use Illuminate\Database\Eloquent\Model;

class City extends Model{
    
    protected $table = 'kiba_cities';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'name',
		'state_id',
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getCitiesByStates($states = array()){
		return self::whereIn('state_id',$states)->orderBy('name')->get();
	}

	public static function getCityById($cityid){
		return self::where('id',$cityid)->first();
	}
}
