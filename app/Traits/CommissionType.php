<?php

namespace App\Traits;
use App\Models\CommossionType\CommissionType as CommissionTypeModal;

trait CommissionType{
	
	public function commissionType(){
		$commissionType           =  CommissionTypeModal::where('is_selected','yes')->first();
        $data['commissionType']      =  '';
        if($commissionType){
            $data['commissionType']  =  $commissionType->commission_type;
        }

        return $data['commissionType'];
	}
}

?>