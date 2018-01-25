<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\Sessions\Sessions as SavedSessions;
use App\Models\UniqueVisitors\UniqueVisitors;

class SaveCountSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $sessions               =   SavedSessions::whereDate('created_at','=',date('Y-m-d'))->count();
        $uniqueVisitors         =   UniqueVisitors::whereDate('date','=', date('Y-m-d'))->first();
        $uniqueVisitors         =   $uniqueVisitors ? $uniqueVisitors : new UniqueVisitors;
        $uniqueVisitors->count  =   $sessions;
        $uniqueVisitors->date   =   date('Y-m-d');
        $uniqueVisitors->save();
        return $next($request);
    }
}
