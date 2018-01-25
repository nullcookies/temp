<?php

namespace App\Http\Controllers\Admin\Commission;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use View, Auth, Session;
use App\User, DB, Redirect, Image, Response, Crawler;
use App\Models\CategoryCommission;
use App\Models\Checklist\CheckList;

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class CommissionController extends Controller{
    
    public $data;

    public function __construct(){
        $this->data             =   array();
    }

    public function index(Request $request){
        $data                   =   $this->data;
        $data['title']          =   'Commission';       
        
        $data['standard_commission'] = DB::table('selected_commission_standard_price')->get();
        $data['category_commission'] = DB::table('selected_commission_category_price')->paginate(10);
       $res = DB::table('selected_commission_category_price')->select(['category_id'])->count();
       
       $all_cat = DB::table('category')->select(['id','category'])->get();
       foreach($all_cat as $val)
       {
            $res_cat[] = ['category_id' => $val->id, 'category' => $val->category];
       }
       //dd($res_cat);
       if($res == 0){
            DB::table('selected_commission_category_price')->insert($res_cat);
       }
       $ct = DB::table('commission_type')->where('is_selected','yes')->first();
       $data['default_category'] = isset($ct) ? $ct->id : '';     
       $checklist = CheckList::first() ? CheckList::first() : new CheckList;
        $checklist->setted_marketplace_product = 'yes';
        $checklist->save();
        return view('admin/commission/index',$data);
    }
    public function postStandard(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
                'minprice' => 'required|numeric',
                'maxprice' => 'required|numeric',
                'commission'=> 'required|numeric',
        ]);
        DB::table('selected_commission_standard_price')->insertGetId(['min' => $request->minprice, 'max' => $request->maxprice, 'commission' => $request->commission]);
        return redirect()->to('admin/commission')->with('success', 'Record Inserted Successfully !');
    }
    public function setDefaultCategory(Request $request)
    {
        if(!$request->ajax())
        {
            return Response::json([
                'danger' => true,
                'msg'    => "Ajax Parameter ! Something were wrong!" 
                ]);  

        }
        DB::table('commission_type')->update(['is_selected' => 'no']);
        DB::table('commission_type')->where('id', $request->id)->update(['is_selected' => 'yes']);
        $rt = ($request->id == 1) ? 'Category' : 'Standard' ;
        return Response::json([
                'success' => true,
                'msg'    => "Set Default Commission Category : $rt", 
                ]);  
    }

    public function saveStandCommission(Request $request)
    {
        if(!$request->ajax()){
            exit;
        }
        $result = DB::table('selected_commission_standard_price')->where('id',$request->id)->update([
                'min'=>$request->min, 
                'max'=>$request->max, 
                'commission'=>$request->comm]);  
        return Response::json([
                'success' => true,
                'data'   => $result,
                'msg'    => "Record Updated." 
                ]);        
    }
    public function deleteStandCommission(Request $request){
        if($request->id){
            DB::table('selected_commission_standard_price')->where('id',$request->id)->delete();
            return Response::json([
                    'danger' => true,                
                    'msg'    => "Record Deleted." 
                    ]); 
        }
    }

    public function saveCatCommission(Request $request)
    {
        //dd($request->all());
        $res_cat = [];        
        foreach($request->catcommission as $key => $value){
            CategoryCommission::where('category_id', $request->catid[$key])->update(['price'=>$value]);
        }

        return Redirect::back();
    }
   /* public function fetchCategory(Request $request){

        if(!isset($request->value)){
            exit;
        }

        if(!$request->ajax()){
            exit;
        }

        if($request->value != 'category_commission' ){
            exit;
        }
        
        $data                   =   $this->data;
        $data['categories']     =   DB::table('category')->paginate(10);

        foreach($data['categories'] as $category){
            $categoryCommission                           = DB::table('selected_commission_category_price')->where('commission_type','category_commission')->where('category_id',$category->id)->first();
            $data['categoryPrice'][$category->id]         = ($categoryCommission && !is_null($categoryCommission)) ? $categoryCommission->price : 0;
        }

        return view('admin/commission/ajax/categories',$data);
    }

    public function saveCommission(Request $request){

        if(!$request->ajax()){
            return Response::json(array('fail' => true,'message' => 'invalid request'));
            exit;
        }

        if(!isset($request->commission_type)){
            return Response::json(array('fail' => true,'message' => 'invalid parameter'));
            exit;
        }

        DB::table('commission_type')->update(array('is_selected'=>'no'));

        if($request->commission_type == 'standard_commission'){

            if(!isset($request->standard_commission_price) || !is_numeric($request->standard_commission_price) || is_null($request->standard_commission_price)){
                return Response::json(array('success' => true,'message' => 'Invalid Parameters'));
                exit;
            }

            $update                 =   DB::table('commission_type')->where('commission_type',$request->commission_type)->update(array('is_selected' => 'yes', 'price' => $request->standard_commission_price ));
            
            $resultArr              =   array();

            if($update){
                $resultArr              =   ['success' => true,'message' => 'Successfully saved','calcval' => 300, 'afterComm' => (300*$request->standard_commission_price)/100 , 'type' => 'standard'];
            }

            if(!$update){
                $resultArr          =   ['fail' => true,'message' => 'Commission Not Updated'];
            }

            return Response::json($resultArr);
            exit;
        }

        if($request->commission_type == 'category_commission'){

            $exitAll                =   false;
            $categories             =   DB::table('category')->where('parentId',0)->select('id')->get();

            foreach ($categories as $category) {
                
                $parameter          =   'cat_'.$category->id;
                if(!isset($request->$parameter) || is_null($request->$parameter) || !is_numeric($request->$parameter) ){
                    return Response::json(array('fail' => true,'message' => 'Please Fill commission for all categories'));
                    $exitAll        =   true;
                    exit;
                }
            }

            if($exitAll){
                exit;
            }

            $update                 =   DB::table('commission_type')->where('commission_type',$request->commission_type)->update(array('is_selected' => 'yes'));

            if($update){
                foreach ($categories as $category) {
                    $parameter          =   'cat_'.$category->id;
                    
                    $selector         =   DB::table('selected_commission_category_price')->where('commission_type',$request->commission_type);
                    $search           =   $selector->where('category_id',$category->id)->get();
                    $query            =   ($search) ? $selector->where('category_id',$category->id)->update(array('price' => $request->$parameter )) : $selector->insert(array('commission_type' => $request->commission_type ,'category_id' => $category->id ,'price' => $request->$parameter ));
                }
            }

            return Response::json(array('success' => true,'message' => 'Saved Successfully'));
            exit;
        }
    }*/
}
