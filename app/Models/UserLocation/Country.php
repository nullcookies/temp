<?php

namespace App\Models\UserLocation;

use Illuminate\Database\Eloquent\Model;

class Country extends Model{
    
    protected $table = 'kiba_countries';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'sortname',
		'name',
		'phonecode',
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getAllCountries(){
		return self::all();
	}

	public static function getCountryById($id){
		return self::where('id',$id)->get();
	}

	public static function getIndia(){
		return self::where('sortname','IN')->get();
	}
}
