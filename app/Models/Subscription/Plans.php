<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model{
    protected $table = 'product_plan';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'plan',
		'price'
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getAllPlans(){
		return self::all();
	}

	public static function getAllIdArr(){
		$plans 		=	self::getAllPlans();
		
		$planArr 		=	array();
		foreach($plans as $plan){
			$planArr[] 	=	$plan->id;
		}
		return $planArr;
	}

	public static function getCommSeperateId(){
		$plans 		=	self::getAllIdArr();

		$planidstr 	=	'';
		foreach($plans as $plan){
			$planidstr .= $plan.',';
		}
		return $planidstr;
	}
}
