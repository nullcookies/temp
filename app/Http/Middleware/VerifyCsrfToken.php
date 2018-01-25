<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier{
   
    protected $except = [
        '/api/order_api',
        '/api/return_api',
        '/order/getSuccess',
        'api/order_product_api',
        'api/getloginbyapi',
        '/order/getFail',
        'indipay/getsuccess',
        'indipay/getcancel'
    ];
}
