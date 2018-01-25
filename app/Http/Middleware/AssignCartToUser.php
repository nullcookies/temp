<?php

namespace App\Http\Middleware;

use Closure, Auth, Session;
use App\Models\Cart\Cart;

class AssignCartToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Auth::guest()){
            Session::put('previous_session_id', app('request')->session()->getId());
        }
        
        if(Auth::user() && Session::has('previous_session_id')){
            
            
            $carts = Cart::where('user_id', Session::get('previous_session_id'))->get();
            
            foreach($carts as $cart){
               $update =  Cart::where('id', $cart->id)->update(['user_id' => Auth::user()->id]);
               
               if($update){
                   Session::forget('previous_session_id');
               }
            }
        }
        return $next($request);
    }
}
