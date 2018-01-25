<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash, Auth;
use App\User, Mail;

class UpdatePasswordController extends Controller{
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function update(Request $request){
        
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::user()->id);
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $request->session()->flash('success', 'Your password has been changed.');
            
            Mail::send('emails.passwordchange', ['user' => $user], function ($m) use ($user) {
                $m->from('payments@techturtle.in', 'Techturtle');
    
                $m->to($user->email,$user->name)->subject('Password Successfully Reset');
            });

            return back();
        }

        $request->session()->flash('failure', 'Your password has not been changed.');

        return back();

    }
}
