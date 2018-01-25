<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use App\Models\Trial\Trial;
use Closure, Carbon\Carbon, Auth;

class GetDisableAdminTrial{
    public function handle($request, Closure $next){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $trial  = Trial::orderBy('created_at','desc')->first();
        if($trial && Auth::user()){
            $created = Carbon::now();
            $difference = ($created->diff($trial->created_at)->days);
            if($difference > 7 && !in_array($currentPath, ['admin','/'])){
                return redirect('/admin');
            }
        }
        return $next($request);
    }
}
