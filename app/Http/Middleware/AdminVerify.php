<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminVerify{

    public function handle($request, Closure $next, $guard = null){
        
        if (!Auth::user() || Auth::user()->user_type != 'admin' ) {
            return redirect('/logout');
        }

        return $next($request);
    }
}
