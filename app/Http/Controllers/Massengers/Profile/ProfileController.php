<?php

namespace App\Http\Controllers\Massengers\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User, Auth;
use App\Models\Orders\Orders, Response;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Carbon\Carbon;

class ProfileController extends Controller{
    
    protected $data = [];
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function showProfile(){
        $data['addresses'] = User::find(Auth::user()->id)->addresses;
        $data['orders']    = User::find(Auth::user()->id)->orders;
        $user = User::find(Auth::user()->id);
        $profileimage  = url('/images/profile_image/demo_image.jpg');
        
        if(strlen($user->profile_image) && File_exists(public_path('/images/profile_image/'.$user->profile_image))){
            $profileimage  = url('/images/profile_image/'.$user->profile_image);
        }
        
        $data['profile_image'] = $profileimage;
        return view('massengers/profile/profile', $data);
    }
    
    public function updateprofile(UpdateProfileRequest $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->dob = Carbon::parse($request->dob)->format('Y-m-d');
        
        if(!$user->save()){
            return Response::json(array('message' => 'Unexpected Error'), 421);
        }
        
        return Response::json(array('message' => 'successfully'), 202);
    }
    
    public function uploadprofileimage(Request $request){
        
        if(!$request->has('image')){
            return Response::json(['error' => 1,'message' => 'Image not found']);
        }
        
        $data = $request->image;
        
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        
        $data = base64_decode($data);
        $imageName = time().'.png';
        if(file_put_contents(public_path('/images/profile_image/'.$imageName), $data)) {
            $user = User::find(Auth::user()->id);
            $user->profile_image = $imageName;
            
            if(!$user->save()){
                return Response::json(['error' => 1,'message' => 'Image not uploaded, try again']);exit;
            }
        }
        return Response::json(['error' => 0,'message' => 'Image successfully uploaded']);
    }
}
