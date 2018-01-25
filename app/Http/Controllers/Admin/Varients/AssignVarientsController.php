<?php

namespace App\Http\Controllers\Admin\Varients;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, DB, Session, Redirect, Response, App\Models\Product\Product;

class AssignVarientsController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data 	=	array();
    }

    public function index(Request $request){

    	if(!$request->has('c')){
    		return redirect('/404');
    		exit;
    	}

    	$data 			=	$this->data;

        $data['availableVarients']  =   DB::table('varient_types')/*->whereIn('varient_type',['size','color'])*/->get();
    	$product_varient_price	    =	DB::table('product_varient_price')->where('product_id',$request->c)->get();
        $productPrice = array();
        foreach ($product_varient_price as $key => $value) {
            $varients = Self::varienttypeByid($value->varients);  // Return String            
            $productPrice[$key]['id']         = $value->id;
            $productPrice[$key]['product_id'] = $value->product_id;
            $productPrice[$key]['varients']   = $varients;
            $productPrice[$key]['price']      = $value->price;
        }
        $data['productVarient'] = $productPrice;


        foreach($data['availableVarients'] as $varient){
            $selectedVars                         =   self::selectedVarients($request->c, $varient->id);

            $selectedVararr                       =   array();
            foreach($selectedVars as $selectedVar){
                $selectedVararr[]                 =   $selectedVar->varient_type_value_id;
            }

            $data['varientValues'][$varient->id]  =   DB::table('varient_type_values')->where('varient_type_id',$varient->id)->whereNotIn('id',$selectedVararr)->get();
            $data['selectValues'][$varient->id]   =   DB::table('selected_varient_for_product')
            ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
            ->select('selected_varient_for_product.id','varient_type_values.value','selected_varient_for_product.varient_type_value_id')
            ->where('selected_varient_for_product.product_id',$request->c)
            ->where('selected_varient_for_product.varient_type_id', $varient->id)
            ->get();
        }
        $data['productid']  = $request->c; 
    	return view('admin/assign_varient/selectVarients', $data);
    }
    
    public function selectedVarients($productid, $varient_type_id){
        $selectedVars                         =   DB::table('selected_varient_for_product')
            ->where('product_id',$productid)
            ->where('varient_type_id',$varient_type_id)
            ->get();

        return $selectedVars;
    }

    public function insertValueToVarient(Request $request){

        if(!$request->ajax()){
            echo 'Bad Request';
            exit;
        }

        if(!isset($request->varient_type_id) || is_null($request->varient_type_id) || !is_numeric($request->varient_type_id)){
            echo 'Bad Request';
            exit;
        }

        if(!isset($request->varient_value) || str_word_count($request->varient_value)<1){
            return Response::json(array('error' => true, 'message' => 'Please Fill Varient Value'));
            exit;
        }

        $insertValue        =   DB::table('varient_type_values')->insertGetId(array(
            'varient_type_id'   => $request->varient_type_id,
            'value'             => $request->varient_value,
        ));

        if(!$insertValue){
            return Response::json(array('error' => true, 'message' => 'Varient Type Cant saved, try again..'));
        }

        return Response::json(array('success' => true, 'message' => 'Varient Successfully' , 'data' => array('id' => $insertValue, 'value' => $request->varient_value)));
    }

    public function selectProductVarientValue(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!isset($request->varientId) || !isset($request->varientValueId) || !isset($request->product_id)){
            echo 'Invalid parameters';
            exit;
        }

        $data          =    $this->data;
        
        $product       =    Product::where('id',$request->product_id)->select('quantity')->first();
        
        $committedQuantity = 0;
        if($product){
            $committedQuantity = $product->quantity;
        }
+
+       
+
         $check         =   DB::table('selected_varient_for_product')->where('product_id',$request->product_id)->where('varient_type_id',$request->varientId)->where('varient_type_value_id',$request->varientValueId)->select('id')->first();
        
        if(!$check){
            DB::table('selected_varient_for_product')->insert(['product_id' => $request->product_id, 'varient_type_id' => $request->varientId , 'varient_type_value_id' => $request->varientValueId,'quantity' => $committedQuantity]);
        }

        $data['renderResult']  =    DB::table('selected_varient_for_product')
        ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
        ->select('selected_varient_for_product.id','varient_type_values.value')
        ->where('selected_varient_for_product.product_id',$request->product_id)
        ->where('selected_varient_for_product.varient_type_id', $request->varientId )
        ->get();

        $data['productid']      =   $request->product_id;
        $data['varientTypeId']  =   $request->varientId;

        return view('admin/assign_varient/ajax/selectedProductVarients', $data);
    }

    public function getAllAvailableVarientValue(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!isset($request->varientTypeId) || !isset($request->productid)){
            echo 'invalid parameters';
            exit;
        }

        $data                                 =   $this->data;
        $selectedVars                         =   self::selectedVarients($request->productid, $request->varientTypeId);

        $selectedVararr                       =   array();
        foreach($selectedVars as $selectedVar){
            $selectedVararr[]                 =   $selectedVar->varient_type_value_id;
        }

        $data['renderResult']                 =   DB::table('varient_type_values')->where('varient_type_id',$request->varientTypeId)->whereNotIn('id',$selectedVararr)->select('id','value')->get();
        $data['productid']                    =   $request->productid;
        $data['varientTypeid']                =   $request->varientTypeId;
        return view('admin/assign_varient/ajax/availableProductVarients', $data);
    }

    public function removeSelectedVarientValue(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!isset($request->selectedVarientId)){
            echo 'invalid parameters';
            exit;
        }

        $deleteVarient                        =   DB::table('selected_varient_for_product')->where('id',$request->selectedVarientId)->delete();
        
        if(!$deleteVarient){
            return Response::json(array('fail' => true, 'message' => 'Cant deleted this time, try again letter'));
        }

        return Response::json(array('success' => true, 'message' => 'successfully deleted'));
    }

    public function getAllSelectedVarients(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!isset($request->productid) || !isset($request->varientTypeId)){
            echo 'Invalid parameters';
            exit;
        }

        $data                                 =   $this->data;
        $data['renderResult']  =    DB::table('selected_varient_for_product')
        ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
        ->select('selected_varient_for_product.id','varient_type_values.value')
        ->where('selected_varient_for_product.product_id',$request->productid)
        ->where('selected_varient_for_product.varient_type_id', $request->varientTypeId )
        ->get();

        $data['productid']      =   $request->productid;
        $data['varientTypeId']  =   $request->varientTypeId;

        return view('admin/assign_varient/ajax/selectedProductVarients', $data);
    }
    public function getProductVarient(Request $request){

        if(!$request->ajax()){
            echo 'bad request';
            exit;
        }

        if(!isset($request->productid) || !isset($request->varientTypeId)){
            echo 'Invalid parameters';
            exit;
        }

        $data['availableVarients']  =   DB::table('varient_types')->whereIn('varient_type',['size','color'])->get();
        foreach($data['availableVarients'] as $varient){
            $selectedVars                         =   self::selectedVarients($request->productid, $varient->id);

            $selectedVararr                       =   array();
            foreach($selectedVars as $selectedVar){
                $selectedVararr[]                 =   $selectedVar->varient_type_value_id;
            }
            $data['selectValues'][$varient->id]   =   DB::table('selected_varient_for_product')
            ->join('varient_type_values','varient_type_values.id','=','selected_varient_for_product.varient_type_value_id')
            ->select('selected_varient_for_product.id','varient_type_values.value','selected_varient_for_product.varient_type_value_id')
            ->where('selected_varient_for_product.product_id',$request->productid)
            ->where('selected_varient_for_product.varient_type_id', $varient->id)
            ->get();
        }
        $data['productid']  = $request->productid;        
        return view('admin/assign_varient/ajax/getProductVarient', $data);
    }
    public function postProductVarient(Request $request)
    {        
        if(!isset($request->varient_type) || !isset($request->productPrice)){
            Session::flash('success_varient','Not Saved try again');
            return Redirect::back();
            exit;
        }
        $varients           = implode(',',$request->varient_type);
        $insertValue        =   DB::table('product_varient_price')->insertGetId([
            'product_id'    => $request->productid,
            'varients'      => $varients,
            'price'         => $request->productPrice,
        ]); 
        if(!$insertValue){
            Session::flash('danger','Data Cant saved');
            return Redirect::back();
        }
        Session::flash('success','Record Successfully Saved');
        Session::flash('success_varient','Successfully Saved');
        if($request->has('redirect_product')){
            return redirect('admin/product/editProduct?c='.$request->productid);    exit;
        }
        return redirect('admin/assign_varients?c='.$request->productid);        
    }
    public function deleteProductVarient(Request $request)
    {       
        Session::flash('success_varient','Deleted Successfully');
        $deleteQuery = DB::table('product_varient_price')->where('id',$request->product_varient_id)->delete();        
        if($deleteQuery)
        {            
            Session::flash('success','Product Varient Deleted.');            
            return Redirect::back();
        }
        else
        {            
            Session::flash('danger', "Due to some error the item is not removed from system.. Try again !!");
            return Redirect::back();
        }        
    }
    public function varienttypeByid($varienttypeid)
    {        
        $data = DB::table('varient_type_values')->whereIn('id',explode(',',$varienttypeid))->select(['value'])->get();
        foreach ($data as $key => $value) {
            $dd[] = $value->value;
        }
        return(implode(' + ',$dd));
    }
}
