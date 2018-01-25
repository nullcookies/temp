<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model{
    
    protected $table = 'product_desc';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'product_name',
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getThemes(){
		return self::all();
	}

	public static function getThemeById($themeid){
		return self::where('id', $themeid)->first();
	}

	public static function getAllIdArr(){
		$themes 		=	self::getThemes();
		
		$themeArr 		=	array();
		foreach($themes as $theme){
			$themeArr[] 	=	$theme->id;
		}
		return $themeArr;
	}

	public static function getCommSeperateId(){
		$themes 		=	self::getAllIdArr();

		$themeidstr 	=	'';
		foreach($themes as $theme){
			$themeidstr .= $theme.',';
		}
		return $themeidstr;
	}
}
