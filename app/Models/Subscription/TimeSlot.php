<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model{
    
    protected $table = 'time_slot';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'slotname',
		'equalday'
	);
	public $timestamps = false;

	public function  __construct(){}

	public static function getAllSlots(){
		return self::all();
	}

	public static function getSlotById($slotid){
		return self::where('id', $slotid)->first();
	}

	
}
