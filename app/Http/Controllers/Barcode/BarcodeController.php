<?php

namespace App\Http\Controllers\Barcode;

use Illuminate\Http\Request;
use App\Helper\OmrCode;
use App\Http\Requests,Redirect;
use App\Http\Controllers\Controller;

class BarcodeController extends Controller{
    
    public $omrcode;

    public function __construct(){
        //$this->middleware('web');
    }
    public function getbarcode($barcodeText){
        dd('TD');
        $url = "http://kibakibi.com/barcode/".$barcodeText;
    	return Redirect::to($url);
    	//new OmrCode($barcodeText);
    }
}
