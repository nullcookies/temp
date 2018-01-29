<?php

namespace App\Http\Controllers\Admin\ShippingCharges;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingCharge\AddShippingChargeRequest;
use App\Http\Requests\ShippingCharge\UpdatePincodeRequest;
use App\Http\Requests\ShippingCharge\UpdateShippingChargeRequest;
use App\Http\Requests\ShippingCharge\DeleteShippingZoneRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use View, Auth, Session;
use App\User, DB, Redirect, Response;

/*
   [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class ShippingChargesController extends Controller{
    public $data;

    public function __construct(){
        $this->data             =   array();
    }

    public function index(Request $request){
        $data                   =   $this->data;
        $data['title']          =   'Shipping Charges';
        $recoardPerpage         =   10;
        $data['weights']        =   DB::table('delivery_weight')->get();
        Session::flash('old',$request->old());
        $data['zones']          =   DB::table('delivery_zones')->paginate($recoardPerpage);
        $data['weights']        =   DB::table('delivery_weight')->get();
        foreach ($data['zones'] as $zone) {
            $charges             =  DB::table('delivery_charges')->where('zone_id',$zone->id)->get();
            foreach ($charges as $charge) {
               $data['charge'][$zone->id][$charge->delivery_weight_id]    =  $charge->price;
            }

            $data['pincode'][$zone->id]   =   DB::table('pincodes')->where('zone_id',$zone->id)->count();
            $pincodes                     =   DB::table('pincodes')->where('zone_id',$zone->id)->select('pincode','city_name','cod_available')->get();
            $pinarr               = array();
            $filename   =   public_path()."/lteadmin/log_files/pincodes/pincode".$zone->id.".csv";
            $myfile     =   !file_exists($filename) ? fopen($filename, "w") : fopen($filename, "w") ;
            foreach ($pincodes as $pincode) {
                $pinarr           =   array($pincode->pincode,$pincode->city_name,$pincode->cod_available);
                try{
                $list = array($pinarr);
                foreach ($list as $fields) {
                    fputcsv($myfile, $fields);
                }
                
            }catch(\Exception $e){
            }
            }
        }fclose($myfile);
        $data['current_page']   = $data['zones']->currentPage();
        $data['index_items']    = ($recoardPerpage*$data['current_page'])-($recoardPerpage-1);
        return view('admin/shipping_charges/shipping_charges',$data);
    }

    public function get_modal_content(Request $request){
        if(!$request->ajax()){
            echo 'Invalid Request';
            exit;
        }

        $data                   =   $this->data;
        $data['weights']        =   DB::table('delivery_weight')->get();

        $data['Old']            =   Session::has('old') ? Session::get('old') : false;
        $data['mime_error']     =   Session::has('incorrect_mime') ? Session::get('incorrect_mime') : false;
        return view('admin/shipping_charges/ajax/add_shipping_charge', $data);
    }

    public function save_shipping_charges(AddShippingChargeRequest $request){
        
        $file_mime_type         =   $request->pincodes->getMimeType();
        
        if($file_mime_type!='text/plain'){
            $request->flash();
            Session::flash('incorrect_mime','the file should me an csv or xls file');
            return Redirect::back();
            exit;
        }   

        $insertZone             =   DB::table('delivery_zones')->insertGetId(array(
            'zone_name'         =>  $request->zone_name,
            'inserted_by'       =>  Auth::user()->id,
        ));

        if(!$insertZone){
            //continue;
        }

        $weights                =   DB::table('delivery_weight')->get();

        foreach ($weights as $key => $weight) {
            
            $insertPrice                = DB::table('delivery_charges')->insert(array(
                'zone_id'               =>  $insertZone,
                'delivery_weight_id'    =>  $weight->id,
                'price'                 =>  $request[$weight->weight_in_gms.'_gms'],
            ));
        }

        $file = fopen($request->file('pincodes'),"r");
        $filename   =   public_path()."/lteadmin/log_files/pincode".uniqid().".csv";

        while(!feof($file)){
            $csv                =   fgetcsv($file);
            $available_column   =   sizeof($csv);
            $max_columns        =   3;

            $notSavedPincode    =   array();

            if($max_columns     != $available_column){
                continue;
            }

            $filedArray            =   array('pincode','city_name','cod_available');
            
            foreach ($filedArray as $key => $value) {
               $data[$value]       =   $csv[$key];
            }

            if(!is_numeric($data['pincode']) || !in_array($data['cod_available'], ['yes','no'])){
                continue;
            }

            $pincodeTable          =    DB::table('pincodes')->insert(array(
                'zone_id'          =>   $insertZone,
                'pincode'          =>   $data['pincode'],
                'city_name'        =>   $data['city_name'],
                'cod_available'    =>   $data['cod_available'],
            ));

            if(!$pincodeTable){
                continue;
            }

            try{
                $list = array($csv);
                $myfile     =   !file_exists($filename) ? fopen($filename, "w") : fopen($filename, "a") ;
                foreach ($list as $fields) {
                    fputcsv($myfile, $fields);
                }
                fclose($myfile);
            }catch(\Exception $e){
            }
        }
        fclose($file); 
        return Redirect::back();
    }

    public function update_pincodes(UpdatePincodeRequest $request){

        $zoneExist              =   DB::table('delivery_zones')->where('id',$request->zone)->count();

        if(!$zoneExist){
            return Redirect::back();
        }

        $zone_id                =   $request->zone;

        $file_mime_type         =   $request->pincode_csv->getMimeType();
        
        if($file_mime_type!='text/plain'){
            $request->flash();
            Session::flash('incorrect_upload_csv_format','the file should me an csv file');
            return Redirect::back();
        } 

        $file = fopen($request->file('pincode_csv'),"r");

        $pincodeArr             =   array();
        while(!feof($file)){
            $csv                =   fgetcsv($file);
            $countField         =   sizeof($csv);

            if($countField != 3 || !is_numeric($csv[0])){
                continue;
            }

            $pincodeArr[]       =   $csv;
        }

        fclose($file);

        $existingPincodes       =   DB::table('pincodes')->where('zone_id',$zone_id)->select('id','pincode')->get();
        
        $to_be_deleted          =   array();

        foreach ($existingPincodes as $existingPincode) {
           $existingPincodes[]    = $existingPincode->pincode;   
        }

        foreach ($pincodeArr as $csvValue) {
            
            if(in_array($csvValue[0], $existingPincodes)){
                continue;
            }

            $insert             =   DB::table('pincodes')->insert(array(
                'zone_id'       =>  $zone_id,
                'pincode'       =>  $csvValue[0],
                'city_name'     =>  $csvValue[1],
                'cod_available' =>  $csvValue[2],
            ));
        }

        return Redirect::back();
    }

    public function edit_zone_detail(UpdateShippingChargeRequest $request){
        $zoneExist              =   DB::table('delivery_zones')->where('id',$request->new_zone_id)->count();

        if(!$zoneExist){
            $request->flash();
            return Redirect::back();
        }

        $zone_name              =   $request->new_zone_name;
        $zone_id                =   $request->new_zone_id;

        $updateZone             =   DB::table('delivery_zones')->where('id',$zone_id)->update(array(
            'zone_name'         =>  $zone_name,
            'inserted_by'       =>  Auth::user()->id,
        ));

        $weights                =   DB::table('delivery_weight')->get();

        foreach ($weights as $weight) {
            $weightIdAlias         =   $weight->weight_in_gms.'_id';
            $weightValueAlias      =   'new_'.$weight->weight_in_gms;
            $weith_id              =   $request->$weightIdAlias;
            $newWeight             =   $request->$weightValueAlias;
            $updatePrice           =   DB::table('delivery_charges')->where('zone_id',$zone_id)->where('delivery_weight_id',$weight->id)->update(array(
                'price'           =>   $newWeight,      
            ));
        }
        return Redirect::back();
    }   

    public function delete_zone(DeleteShippingZoneRequest $request){
        $zoneExist              =   DB::table('delivery_zones')->where('id',$request->delete_zone_id)->count();

        if(!$zoneExist){
            $request->flash();
            return Redirect::back();
        }

        $zone_id               =   $request->delete_zone_id;
        $delete                 =   DB::table('delivery_zones')->where('id',$zone_id)->delete();

        return Redirect::back();
    }

    public function fetch_pincode(Request $request){
        
        if(!$request->ajax()){
            echo 'invalid';
            exit;
        }
        $data                   =   $this->data;
        $pincode                =   $request->pincode;

        $data['records']          =   DB::table('pincodes')->join('delivery_zones','delivery_zones.id','=','pincodes.zone_id')->select('pincodes.id','pincodes.cod_available','delivery_zones.zone_name')->where('pincode',$pincode)->get();

        return view('admin/shipping_charges/ajax/pincode_search_result',$data);
    }
}
