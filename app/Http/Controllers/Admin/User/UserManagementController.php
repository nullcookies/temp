<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Admin\UserManagement\DeleteUserRequest;
use App\Http\Requests\Admin\UserManagement\ResetPasswordRequest;
use App\Http\Requests\Admin\UserManagement\SaveUserRequest;
use App\Http\Requests\Admin\UserManagement\UpdateUserRequest;
use App\Http\Requests\Admin\UserManagement\UpdateAccessModeRequest;
use App\Http\Requests\Admin\UserManagement\UpdateUserTypeRequest;
use Illuminate\Http\Request;
use View, Auth, Session;
use App\User, DB, Redirect;

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class UserManagementController extends Controller{
    public $data;

    public function __construct(){
        $this->data             =   array();
        
    }

    public function index(){
        $data                   =   $this->data;
        $data['project_name']   =   PROJECT_NAME;
        $numberOfRecoards       =   10;
        $data['canwrite']       =   (Auth::user()->authority == 2) ? true : false;
        $data['access_modes']   =   DB::table('authorities')->get();
        $users                  =   User::leftJoin('authorities','authorities.id','=','users.authority')->select('users.id','users.name','users.mobile','users.email','users.created_at','users.updated_at','users.user_type','authorities.authority','users.user_gender','authorities.id as authorityid');

        if(isset($_GET['user_type']) && $_GET['user_type'] != '' && $_GET['user_type'] != 'all'){
            $users              =   $users->where('user_type',$_GET['user_type']);
        }

        if(isset($_GET['access_mode']) && $_GET['access_mode'] != '' && $_GET['access_mode'] != 'all'){
            $users              =   $users->where('authorities.id',$_GET['access_mode']);
        }

        if(isset($_GET['q']) && $_GET['q'] != '' ){
            $searchVar          =   $_GET['q'];
            $users              =   $users->where(function($query) use ($searchVar){
                $query->where('name','like','%'.$searchVar.'%');
                $query->orWhere('mobile','like','%'.$searchVar.'%');
                $query->orWhere('email','like','%'.$searchVar.'%');
            });
        }

        if(Session::has('created_user_id')){
            $users              =   $users->where('users.id',base64_decode(Session::get('created_user_id')));
        }

        $data['users']          =   $users->orderBy('users.created_at','DESC')->groupBy('users.id')->paginate($numberOfRecoards);

        $data['filterq']        =   isset($_GET['q']) ? $_GET['q'] : '';
        $data['filter_user_type']   =   isset($_GET['user_type']) ? $_GET['user_type'] : '';
        $data['filter_access_mode'] =   isset($_GET['access_mode']) ? $_GET['access_mode'] : '';

        return view('admin.user.user_management', $data);
    }

    public function deleteUser(DeleteUserRequest $request){
        $user_id                =   $request->user_id;
        $checkUser              =   User::find($user_id);

        if(!$checkUser || count($checkUser) < 1){
            Session::flash('err_msg','Sorry This user does not exist, So we cant perform delete query..');
            return Redirect::back();
            exit;
        }

        $deleteQuery            =   DB::table('users')->where('id',$user_id)->delete();

        if(!$deleteQuery){
            Session::flash('err_msg','Sorry The user is not deleted, try again..');
            return Redirect::back();
            exit;
        }

        Session::flash('success_msg','User Deleted Successfully..');
        return Redirect::back();
    }

    public function reset_password(ResetPasswordRequest $request){

        $user_id                =   $request->user_id;
        $checkUser              =   User::find($user_id);

        if(!$checkUser || count($checkUser) < 1){
            Session::flash('err_msg','Sorry This user does not exist, So we cant perform delete query..');
            return Redirect::back();
            exit;
        }

        $password               =   bcrypt($request->new_password);
        $user                   =   User::find($user_id);
        $user->password         =   $password;

        if(!$user->save()){
            Session::flash('err_msg','Sorry Password Cant changed, try again..');
            return Redirect::back();
            exit;
        }

        Session::flash('success_msg','Password Successfully changed.<a class="btn btn-outline-white" href="'.url(ADMIN_URL_PATH.'/user_management').'">Reload</a> to view all recoards.');
        Session::flash('created_user_id',base64_encode($user_id));
        return Redirect::back();
    }

    public function create_user(Request $request){

        $data                   =   $this->data ;
        $data['title']          =   'Create User';
        $data['access_modes']   =   DB::table('authorities')->get();   
        return view('admin/user/create_user', $data);
    }

    public function save_user(SaveUserRequest $request){

        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }

        $user                   =   new User;
        $user->name             =   $user_name;
        $user->email            =   $user_email;
        $user->mobile           =   $mobile_number;
        $user->password         =   bcrypt($password);
        $user->user_gender      =   $gender;
        $user->user_type        =   $user_type;
        $user->authority        =   $access_mode;

        if(!$user->save()){
            Session::flash('err_msg','Sorry User Cant Created, try again..');
            return redirect(ADMIN_URL_PATH.'/user_management');
            exit;
        }

        Session::flash('success_msg','User created successfully.<a class="btn btn-outline-white" href="'.url(ADMIN_URL_PATH.'/user_management').'">Reload</a> to view all recoards.');
        Session::flash('created_user_id',base64_encode($user->id));
        return redirect(ADMIN_URL_PATH.'/user_management');
    }

    public function edit_user_basic_info(UpdateUserRequest $request){
        // edit basic info script here
        $user_id                =   $request->update_user_id;
        $checkUser              =   User::find($user_id);

        if(!$checkUser || count($checkUser) < 1){
            Session::flash('err_msg','Sorry This user does not exist, So we cant perform delete query..');
            return Redirect::back();
            exit;
        }

        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }

        $user                   =   User::find($user_id);
        $user->name             =   $update_customer_name;
        $user->mobile           =   $update_customer_mobile;
        $user->user_gender      =   $update_gender;

        if(!$user->save()){
            Session::flash('err_msg','User Info Cant Updated, try again..');
            return Redirect::back();
            exit;
        }

        Session::flash('success_msg','User Info Updated Successfully.<a class="btn btn-outline-white" href="'.url(ADMIN_URL_PATH.'/user_management').'">Reload</a> to view all recoards.');
        Session::flash('created_user_id', base64_encode($user_id));
        return Redirect::back();
    }

    public function update_access_mode(UpdateAccessModeRequest $request){

        $user_id                =   $request->change_access_mode_user_id;
        $checkUser              =   User::find($user_id);

        if(!$checkUser || count($checkUser) < 1){
            Session::flash('err_msg','Sorry This user does not exist, So we cant perform delete query..');
            return Redirect::back();
            exit;
        }

        $checkUser->authority  =    $request->new_access_mode;

        if(!$checkUser->save()){
            Session::flash('err_msg','User Access Mode Cant Updated, try again..');
            return Redirect::back();
            exit;
        }

        Session::flash('success_msg','User Access Mode Updated Successfully. <a class="btn btn-outline-white" href="'.url(ADMIN_URL_PATH.'/user_management').'">Reload</a> to view all recoards.');
        Session::flash('created_user_id',base64_encode($user_id));
        return Redirect::back();
    }

    public function update_user_type(UpdateUserTypeRequest $request){

        $user_id                =   $request->change_user_type_user_id;
        $checkUser              =   User::find($user_id);

        if(!$checkUser || count($checkUser) < 1){
            Session::flash('err_msg','Sorry This user does not exist, So we cant perform delete query..');
            return Redirect::back();
            exit;
        }

        $checkUser->user_type   =   $request->new_user_type;

        if(!$checkUser->save()){
            Session::flash('err_msg','User Type Cant Updated, try again..');
            return Redirect::back();
            exit;
        }

        Session::flash('success_msg','User Type Updated Successfully. <a class="btn btn-outline-white" href="'.url(ADMIN_URL_PATH.'/user_management').'">Reload</a> to view all recoards.');
        Session::flash('created_user_id',base64_encode($user_id));
        return Redirect::back();
    }
}
