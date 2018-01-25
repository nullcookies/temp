<?php

namespace App\Http\Controllers\Admin\NewCommission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\NewCommission\StandardCommissionVarient;
use App\Models\NewCommission\StandardCommissionNew;

class CommissionController extends Controller{
    
    protected $data;
    public function __construct(){
    	$this->data = array();
    }

    public function showPage(Request $request){
    	return view('admin/commission_new/commission');
    }

    public function getShowData(Request $request){
    	$this->data['standard_commission_varient'] = StandardCommissionVarient::all();
    	return response($this->data);
    }
}
