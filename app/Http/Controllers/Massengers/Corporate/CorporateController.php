<?php

namespace App\Http\Controllers\Massengers\Corporate;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CorporateController extends Controller{
    
    public function showcorporate(){
        return view('massengers/corporate/corporate');
    }
    
    public function bulkOrder(){
        return view('massengers/corporate/corporate-detail');
    }
}
