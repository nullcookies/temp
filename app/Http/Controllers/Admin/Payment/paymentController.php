<?php

namespace App\Http\Controllers\Admin\Payment;

use Illuminate\Http\Request;
use User;
use Auth;
use App\Models\Orders\Orders;
use App\Models\Orders\OrderProducts;
use App\Models\ProductCategory\ProductCategory;
use App\Models\Categories_commission\Categories_commission;
use App\Models\Standerd_commission\Standerd_commision;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Api_products\Api_products;
use DateTime;
use DateTimeZone;
use DateInterval;
use DB;
use Excel;
use ArrayObject;
class paymentController extends Controller
{
protected $tax;

public function charts_data(){
	  $n = 0;
	  $payoute = 0;
	  $last_payout = 0;
      $final_data  = array();
      $final_date = array();
      $data = DB::table('commision_ref_table')->orderBy('id', 'desc')->take(28)->get();
      //dd($data);

      foreach($data as $key=>$value){

      	if($n == 0){ 
              $last_date = (string)$this->formate_date($value->date);
              $last_payout = 0;
      	}
        if($last_date == (string)$this->formate_date($value->date)){
         
              $last_payout = $last_payout + (int)$value->commision_amount;
             
        }else{
              $final_data[] = array( "month"=>$last_date,"sales"=>$last_payout);

              $last_payout = (int)$value->commision_amount;
              $last_date = (string)$this->formate_date($value->date);
        }                
	    $last_date = (string)$this->formate_date($value->date);
	    $n++;
	     //$final_data[] = $this->formate_date($value->date);
      	}
         
      	if($last_payout != 0){
            
           // $final_data[]['final_payout']=$last_payout;
      		//$more_array = array("final_payout"=>$last_payout,"last_date"=>$last_date);
           // $final_data['last_date']['final_payout'] = $last_date;
      		//array_push($final_data , $last_payout);
      		//$arr1 = array('final_payout' => $last_payout);
            //$arr2 = array('last_date' => $last_date);
            //$arr3 = $arr1 + $arr2;
      		//$final_data[] = $arr3;
      		//$last_payout = 0;
      	}
        //dd($final_data);
          
       
     return response($final_data);
      }
private function formate_date($date){

      $date1 = explode(" ",$date);
     
      $date2 = explode("-",$date1[0]);
      $the_date =  $date2[0]."-".$date2[1];
      $final_date = (string)$the_date; 
      return $final_date;

}
private function add_same_date_payouts($date,$payouts,$last_date,$last_payout){

    if($date === $last_date){

    }

  
   

}


	public function __construct(){
		$this->tax = 15;
	}
	
	
	
	 public function dounload_csv(Request $request)
    {
	   $array_to_export= array(); 
		$val = $request->id;
		$value =  DB::table('payout_history_with_refference')->where('refference_no',$val)->get();
		foreach($value as $vl){
			$array_to_export[] = array("order_id"=>$vl->order_id,"order_date"=>$vl->order_date,"name"=>$vl->name,"selling_prise"=>$vl->selling_prise,"commission"=>$vl->commission,"order_type"=>$vl->order_type,"taxes"=>$vl->taxes,"shipping"=>$vl->shipping,"product_id"=>$vl->product_id,"refference_no"=>$vl->refference_no);
			
			}
		
		
        Excel::create('Report2016', function($excel) use($array_to_export) {
 
            // Set the title
            $excel->setTitle('Report');

            // Chain the setters
            $excel->setCreator('Me')->setCompany('Our Code World');

            $excel->setDescription('A demonstration to change the file properties');

            $data = $array_to_export;

            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, NULL, 'A3');
            });

        })->download('csv');
    }
	
	
	public function getDataToReffTable(){
		 $value = DB::table('commision_ref_table')->get();
		 return response($value);
		
		}
	public function details_order(Request $request)	{
		$order_details_array = array();
		
		$id = $request->id;
		$reff_id = $request->id1;
		$val =  DB::table('payout_history_with_refference')->where('order_id',$id )->where('refference_no',$reff_id)->get();
		 foreach($val as $vl){
		       	 $order_details_array[] = array("order_id"=>$vl->order_id,"order_date"=>$vl->order_date,"name"=>$vl->name,"selling_prise"=>$vl->selling_prise,"commission"=>$vl->commission,"order_type"=>$vl->order_type,"taxes"=>$vl->taxes,"shipping"=>$vl->shipping,"product_id"=>$vl->product_id,"refference_no"=>$vl->refference_no);
			 }
			//dd($order_details_array);
		 return view('admin.payments.tab2')->with(array('data'=>$order_details_array));
		}
	public function details(Request $request){
		$id_array = array();
		$id = $request->id;
	
        $val =  DB::table('payout_history_with_refference')->select('order_id','refference_no')->groupBy('order_id')->where('refference_no',$id )->get();
		
		foreach($val as $va){
			$id_array[] = array("order_id"=>$va->order_id , "reffernce_no"=>$va->refference_no);
			}
	//	 dd($id_array );
		 
		 
		
		
				//echo $id;
		return view('admin.payments.tab1')->with(array('data' => $id_array));
		}	
	public function view_all_from_reff_cntrl(){
		   return view('admin.payments.allPaymnet');
		}
		
	public function addDataToSubhistoryTable($ref,$amount){
		
		$reference_id = $ref;
		 $commision = DB::table('billed_amount')->get();
		 DB::table('commision_ref_table')->insert(['refrerence_no'=>$reference_id,'commision_amount'=> $amount]);
		 //DB::table('billed_amount')->truncate();
		}	
	public function addDataToHistoryTable(){
		
	$reference_id = mt_rand(1000000000, 9999999999);
	$value = DB::table('payout_history')->get(); 
	//return $value;
	DB::table('billed_amount')->truncate();
	if(count($value)>0){
		  //DB::table('payout_history_with_refference')->truncate();
	}
	foreach($value as $val){
	      DB::table('payout_history_with_refference')->insert(["order_id"=>$val->order_id,"order_date"=>$val->order_date,"name"=>$val->name,"selling_prise"=>$val->selling_price,"commission"=>$val->commision,"order_type"=>$val->order_type,"taxes"=>$val->taxes,"shipping"=>$val->shipping,"product_id"=>$val->product_id,"refference_no"=>$reference_id,]);
		  
		}
	$value_unbilled = DB::table('unbilled_amount')->get();
	if(count($value_unbilled)>0){
	foreach($value_unbilled as $val){
		
		 DB::table('billed_amount')->insert(['amount'=>$val->unbilled_amount]);
		 $this->addDataToSubhistoryTable($reference_id,$val->unbilled_amount);
		 DB::table('unbilled_amount')->truncate();
		  DB::table('unbilled_amount')->insert(['unbilled_amount'=>0]);
	}
		}else{
			DB::table('billed_amount')->insert(['amount'=>0]);
			 DB::table('unbilled_amount')->truncate();
			DB::table('unbilled_amount')->insert(['unbilled_amount'=>0]);
			}
		  
		}
	
	public function get_unbilled_ammount_from_table(){
		$value = DB::table('unbilled_amount')->get();
		return response($value);
		} 
	
	public function get_billed_ammount_from_table(){
		$value = DB::table('billed_amount')->get();
		return response($value);
		} 
	
	
    public function get_payment_page(){
		   return view('admin.payments.payment');
		}
    public function addData_to_billed_account(){
    
	}
	
	public function calculate_gmv(Request $request){
		  $amount = array();
		  $user_details = Auth::user();	
		  $order = new Orders; 
		  $finale_amount= 0;
		  $get_all_ammount = $order::select('orderAmount')->get();  
		  foreach($get_all_ammount as $amount_val){
			  $amount[] = $amount_val->orderAmount;
			  }
		  foreach($amount as $amt){
			  $finale_amount =   $finale_amount + $amt;
			  }	  
		  return response($finale_amount);        
		}	
		
	private function same_product_calculator() {
		
		
		
		}	
	private function inser_data_to_history_table($history_array){
		
    $value = DB::table('payout_history')->get(); 
	if(count($value)>0){
	 DB::table('payout_history')->truncate();
	    }
		
		foreach($history_array as $history){
			
     	DB::table('payout_history')->insert(["order_id"=>$history["order_id"],"product_id"=>$history["product_id"],"name"=>$history["product_name"],"selling_price"=>$history["product_prise"],"commision"=>$history["commission"],"order_type"=>$history["order_type"],"taxes"=>$history["taxes"],"shipping"=>$history["delivery_charges"]]);
			
			}
		
		}	
	public function calculate_unbiled_amount(){
		 $midiatorYear = date('Y');
		 $commision_array = array();
		 $data_for_refference_arrar = array();
		 $user_details = Auth::user();	
		 $midiatorMonth  = date('m');
		 $start = new DateTime( $midiatorYear."-". $midiatorMonth."-24", new DateTimeZone("UTC"));
         $month_later = clone $start;
		 $month_later->add(DateInterval::createFromDateString('-1 month'));
		 $catagory_commision_array = array();
		 $current_day = date('d');
		if($current_day <= "25"){
		     $midiatorYear = date('Y');
		 
		 $midiatorMonth  = date('m');
		 $start = new DateTime( $midiatorYear."-". $midiatorMonth."-12", new DateTimeZone("UTC"));
         $month_later = clone $start;
		 $month_later->add(DateInterval::createFromDateString('-1 month'));
		 $catagory_commision_array = array();
		 $current_day = date('d');
			foreach($month_later as $key=>$value){
				$dateData[$key] = $value;
				}
				$datevalue = explode(" ",$dateData["date"]);
				$order = new Orders;
				$dateFrom = $datevalue[0];
				$dateTo = date('Y-m-d');
				$stop_date = date('Y-m-d', strtotime($dateTo . ' +1 day'));
			//	dd($dateFrom , 	$stop_date);
				$orders = $order::select('id','created_at','shippingPostCode')/*->where('seller_id',$user_details->id)*/->where('status','completed')->whereBetween('created_at', [$dateFrom , 	$stop_date ])->get();
				
			//	dd(	$orders);
				foreach($orders as $key => $value){
				
					$orders_ids[$key] = $value->id;
					$data_for_refference_arrar[$key] =array("order_id"=>$value->id,"order_date"=>$value->created_at,"postal_code"=>$value->shippingPostCode);
					}
				
				//dd($data_for_refference_arrar);	
	      $products_for_commission = new OrderProducts;
			
          $commistiond_product=$products_for_commission::select('order_id','product_id','product_type')->whereIn('order_id',$orders_ids)->get();
	      foreach($commistiond_product as $key => $value){
		   $products_on_commision_calc[$key] = $value->product_id;
		   $product_on_commision_with_type[] = array('id'=>$value->product_id,"type"=>$value->product_type,"order_id"=>$value->order_id);
		 }
		 
		 //here I am calculation refference data order by..........
		
		//calculation commision on a perticular catagories.			
		$categories = $this->get_catagory_of_all_orderd_products($products_on_commision_calc);
				//dd($categories);
				
		
		foreach($categories as $key=>$value){
				///dd($this->check_for_catagories_commision($value));
		if($this->check_for_catagories_commision($value)["retun"] == true){
		$commision_array[] = array("commision_value" => $this->check_for_catagories_commision($value)["value"],"cat_id"=>$this->check_for_catagories_commision($value)["category_id"]);						
		}
		
		}
		$productWithCatPriseArray = $this->product_with_catId_sellPrise($product_on_commision_with_type,$data_for_refference_arrar);	
	   // dd($productWithCatPriseArray);
		$unbilled_Amount = $this->calculate_unbiled_amout_function($commision_array , $productWithCatPriseArray );
		$unbilled_history = $this->calculate_history_function($commision_array , $productWithCatPriseArray );
		//dd($unbilled_history);
		$reff_mid_data = 	$this->get_all_product_of_an_order_id($product_on_commision_with_type,$data_for_refference_arrar,$productWithCatPriseArray);
		//dd($reff_mid_data);
		//dd( $productWithCatPriseArray );
			$this->insert_data_to_unbilled_table($unbilled_Amount);
		    $data = $this->inser_data_to_history_table($unbilled_history);
	   	//  $val = $this->get_prise_vise_commision(100);
		dd( $data );
			}else if ($current_day > "15" && $current_day < "24"){
				
		foreach($month_later as $key=>$value){
				$dateData[$key] = $value;
				}
				$datevalue = explode(" ",$dateData["date"]);
				$order = new Orders;
				$dateFrom = $datevalue[0];
				$dateTo = date('Y-m-d');
				$stop_date = date('Y-m-d', strtotime($dateTo . ' +1 day'));
			//	dd($dateFrom , 	$stop_date);
				$orders = $order::select('id','created_at','shippingPostCode')/*->where('seller_id',$user_details->id)*/->where('status','completed')->whereBetween('created_at', [$dateFrom , 	$stop_date ])->get();
				
			//	dd(	$orders);
				foreach($orders as $key => $value){
				
					$orders_ids[$key] = $value->id;
					$data_for_refference_arrar[$key] =array("order_id"=>$value->id,"order_date"=>$value->created_at,"postal_code"=>$value->shippingPostCode);
					}
				
				//dd($data_for_refference_arrar);	
	      $products_for_commission = new OrderProducts;
			
          $commistiond_product=$products_for_commission::select('order_id','product_id','product_type')->whereIn('order_id',$orders_ids)->get();
	      foreach($commistiond_product as $key => $value){
		   $products_on_commision_calc[$key] = $value->product_id;
		   $product_on_commision_with_type[] = array('id'=>$value->product_id,"type"=>$value->product_type,"order_id"=>$value->order_id);
		 }
		 
		 //here I am calculation refference data order by..........
		
		//calculation commision on a perticular catagories.			
		$categories = $this->get_catagory_of_all_orderd_products($products_on_commision_calc);
				//dd($categories);
				
		
		foreach($categories as $key=>$value){
				///dd($this->check_for_catagories_commision($value));
		if($this->check_for_catagories_commision($value)["retun"] == true){
		$commision_array[] = array("commision_value" => $this->check_for_catagories_commision($value)["value"],"cat_id"=>$this->check_for_catagories_commision($value)["category_id"]);						
		}
		
		}
		$productWithCatPriseArray = $this->product_with_catId_sellPrise($product_on_commision_with_type,$data_for_refference_arrar);	
	   // dd($productWithCatPriseArray);
		$unbilled_Amount = $this->calculate_unbiled_amout_function($commision_array , $productWithCatPriseArray );
		$unbilled_history = $this->calculate_history_function($commision_array , $productWithCatPriseArray );
		//dd($unbilled_history);
		$reff_mid_data = 	$this->get_all_product_of_an_order_id($product_on_commision_with_type,$data_for_refference_arrar,$productWithCatPriseArray);
		//dd($reff_mid_data);
		//dd( $productWithCatPriseArray );
			$this->insert_data_to_unbilled_table($unbilled_Amount);
		    $data = $this->inser_data_to_history_table($unbilled_history);
	   	//  $val = $this->get_prise_vise_commision(100);
		dd( $data );
				

				}else if($current_day > "24" && $current_day < "31"){
					foreach($month_later as $key=>$value){
				$dateData[$key] = $value;
				}
				$datevalue = explode(" ",$dateData["date"]);
				$order = new Orders;
				$dateFrom = $datevalue[0];
				$dateTo = date('Y-m-d');
				$orders = $order::select('id')->where('seller_id',$user_details->id)->where('status','open')->whereBetween('created_at', [$dateFrom , $dateTo ])->get();
				foreach($orders as $key => $value){
					$orders_ids[$key] = $value->id;
					}
				$products_for_commission = new OrderProducts;
				
			     $commistiond_product=$products_for_commission::select('product_id','product_type')->whereIn('order_id',$orders_ids)->get();
				 foreach($commistiond_product as $key => $value){
					     $products_on_commision_calc[$key] = $value->product_id;
						 $product_on_commision_with_type[] = array('id'=>$value->product_id,"type"=>$value->product_type);
					 }
					 
		//calculation commision on a perticular catagories.			 
				$productIds 	=	$products_on_commision_calc;
				
				// do work over here..................
                    //  return response($this->product_with_catId_sellPrise($product_on_commision_with_type));
		$apiProductCat          =  DB::table('api_products')->whereIn('api_product_id',$productIds)->groupBy('categoryId')->select('categoryId')->get();
		$categories             = array();
		foreach($apiProductCat as $apiProduct){
			$categories[]       = $apiProduct->categoryId;
		}


		$simpleProductCat  = DB::table('product_category')->whereIn('product_id',$productIds)->whereNotIn('category_id',$categories)->select('category_id')->get();

		foreach($simpleProductCat as $simpleProduct){
			$categories[]		=	$simpleProduct->category_id;
		}
				//dd($categories);
		foreach($categories as $key=>$value){
				///dd($this->check_for_catagories_commision($value));
				if($this->check_for_catagories_commision($value)["retun"] == true){
		$commision_array[] = array("commision_value" => $this->check_for_catagories_commision($value)["value"],"cat_id"=>$this->check_for_catagories_commision($value)["category_id"]);						
				}
		
		}
		$productWithCatPriseArray = $this->product_with_catId_sellPrise($product_on_commision_with_type);	
		$unbilled_Amount = $this->calculate_unbiled_amout_function($commision_array , $productWithCatPriseArray );
		// $val = $this->get_prise_vise_commision(100);
		$this->insert_data_to_unbilled_table($unbilled_Amount);
		
					
					}

		}	
		
		
private function get_catagory_of_all_orderd_products($productIds){
		$apiProductCat          =  DB::table('api_products')->whereIn('api_product_id',$productIds)->groupBy('categoryId')->select('categoryId')->get();
		$categories             = array();
		foreach($apiProductCat as $apiProduct){
			$categories[]       = $apiProduct->categoryId;
		}
		$simpleProductCat  = DB::table('product_category','product_id')->whereIn('product_id',$productIds)->whereNotIn('category_id',$categories)->select('category_id')->get();
		foreach($simpleProductCat as $simpleProduct){
			$categories[]		=	$simpleProduct->category_id;
		}
		return $categories;
	}		
	
	
private function get_all_product_of_an_order_id($product_on_commision_with_type,$data_for_refference_arrar,$productWithCatPriseArray){
	$order_id_with_date = $data_for_refference_arrar;
	$order_id_with_product_id_and_type = $product_on_commision_with_type;
	$product_id_with_prise_cata_sorted_by_my_req = $productWithCatPriseArray;
	return ($order_id_with_product_id_and_type);
	
	}		
private function insert_data_to_unbilled_table($unbilled_Amount){
	//dd( $unbilled_Amount);
	$value = DB::table('unbilled_amount')->get(); 
	if(count($value)>0){
		DB::table('unbilled_amount')->truncate();
		DB::table('unbilled_amount')->insert(['unbilled_amount'=>$unbilled_Amount]);
		}else{
			DB::table('unbilled_amount')->insert(['unbilled_amount'=>$unbilled_Amount]);
			}
	//dd($value);
	
	}
private function check_for_catagories_commision($categories){
	//dd($categories);
	$catacommistion  =  new Categories_commission;
	$values =  $catacommistion::select('price','category_id')->where('category_id',$categories)->get();
	//  dd($values);
	if(count($values)>0){
		foreach($values as $val){
		return $value = array("retun"=>true,"value"=>$val->price,"category_id"=>$val->category_id);
		}
		}else{
			foreach($values as $val){
		       return $value = array("retun"=>false,"value"=>$val->price,"category_id"=>$val->category_id);
	               	}
			}
	}
//development of array with product_with_catId_sellPrise
private function product_with_catId_sellPrise($productIds,$postalArray){
	$array_for_postal_code = array();
	$GetSimpleProductsIdArray = array();
	//dd($productIds);
	foreach($productIds as $chek_o_id){
		foreach($postalArray as $post){
			
			if($chek_o_id['order_id'] == $post['order_id']){
		 	   $array_for_postal_code[] = array("order_id"=>$post["order_id"],"product_id"=>$chek_o_id["id"],"postal_code"=>$post["postal_code"],"order_type"=>$chek_o_id['type']);
				
				}
			
			}
		}
	//return $array_for_postal_code;
	
	
	foreach($productIds as $val){
		
		if($val['type']=='api'){
		  $GetApiProductsIdArray[] = $val['id'];	
			}else{
				//will use some other time
				$GetSimpleProductsIdArray[] = $val['id'];	
			}
		}
	$GetAllApiProducts = Api_products::whereIn('api_product_id',$GetApiProductsIdArray)->get();
    //dd(	 $GetApiProductsIdArray);
	$product_cat_prise_arry_for_simple_data = array();

	$GetAllSelfProducts = DB::table('product')->whereIn('id',$GetSimpleProductsIdArray)->get();

	//return $GetAllSelfProducts;
	foreach($GetAllApiProducts as $pro){
	$product_cat_prise_array[] = array("procut_cat_id"=>$pro->categoryId,"product_prise"=>$pro->sellingPrice,"product_name"=>$pro->productTitle,"product_id"=>$pro->api_product_id,"product_weigth"=>$pro->weight);
		}
		
	foreach($GetAllSelfProducts as $pro){
		$cat_id=DB::table('product_category')->select('category_id')->where('product_id',$pro->id)->get();
		      $product_cat_prise_arry_for_simple_data[] = array("procut_cat_id"=>$cat_id[0]->category_id,"product_prise"=>$pro->product_selling_price,"product_name"=>$pro->product_name,"product_id"=>$pro->id,"product_weigth"=>$pro->weight);
			}
	$product_cat_prise_arry_for_simple_data_mergerd = array_merge($product_cat_prise_arry_for_simple_data,$product_cat_prise_array);
	
	$final_array= array();
	foreach($array_for_postal_code as $maindata){
		
		foreach($product_cat_prise_arry_for_simple_data_mergerd as $extraData){
		         	// $maindata['product_id'];
					 if($maindata['product_id'] == $extraData['product_id']){
						 
				 $final_array[] = array(
					     "procut_cat_id"=>$extraData["procut_cat_id"],                                                               "product_prise"=>$extraData["product_prise"],
						 "product_name"=>$extraData["product_name"],
						 "product_id"=>$maindata["product_id"],
						 "postal_code"=>$maindata['postal_code'],
						 "order_id"=>$maindata['order_id'],
						 "product_weigth"=>$extraData["product_weigth"],
						 "order_type"=>$maindata["order_type"]
						 );
						 
						 }
			              
			} 
		
		
		}
	
	return  $final_array;
	}
private function shippingCalculator ($maindata){
	$zone = array();
	$weigth = array();
	//return $maindata['product_weigth'];
	$zone_id = DB::table('pincodes')->select('zone_id')->where('pincode',$maindata['postal_code'])->get();
	foreach($zone_id as $zones){
		$zone[] = $zones->zone_id;
		}
	$weigth_id = DB::table('delivery_weight')->select('id')->where('weight_in_gms',$maindata['product_weigth'])->get();
	foreach($weigth_id as $weigths){
		$weigth[] = $weigths->id;
		}
	//	return count($weigth);
	if(count($zone) ==  1 && count($weigth) == 1 ){
	$cahrgers = DB::table('delivery_charges')->select('price')->where('zone_id',$zone[0])->where('delivery_weight_id',$weigth[0])->get();
	$cahrger = $cahrgers[0]->price;
	}else{
		$cahrger = 0;
		 }
	return $cahrger;
	}
private function calculate_history_function($commitionArray , $productWithCatPriseArray ){
	$unbilled_amount_array_ctatagory = array();
	$unbilled_amount_array_prise = array();
	$user_sale_array_data = array();
	$total_unbilled_commisttion = array();
	$new_modified_array = array();
	//dd($productWithCatPriseArray,$commitionArray);
	foreach($productWithCatPriseArray as $key => $test_val){
		
		  
		  $commission_category  = array();
		  $mycommision = array();
		  foreach($commitionArray as $comm_val){
			  $commission_category[] = $comm_val['cat_id'];
			  $mycommision[$comm_val['cat_id']] = $comm_val['commision_value'];
			
		  }
		  if(in_array($test_val['procut_cat_id'], $commission_category)){
			  if($test_val['order_type']=="api"){
			   $commision = ((float) $test_val['product_prise']*(int) $mycommision[$test_val['procut_cat_id']])/100;
    		   $unbilled_amount_array_ctatagory[] = $commision; 
			     $productWithCatPriseArray[$key]['commission'] =  $commision;
				 $productWithCatPriseArray[$key]['taxes'] = 15;
				 $productWithCatPriseArray[$key]['delivery_charges'] =  $this->shippingCalculator($test_val);
			  }else{
				  $user_sale_array_data[] = (float) $test_val['product_prise'];
				    $productWithCatPriseArray[$key]['commission'] =  0;
					 $productWithCatPriseArray[$key]['taxes'] = 0;
					 $productWithCatPriseArray[$key]['delivery_charges'] = $this->shippingCalculator($test_val);
				  }
		  }else{
			  //if($this->get_prise_vise_commision($test_val['product_prise']) != NULL){
				 // dd($test_val['product_prise']);
				// dd($test_val['product_prise']);
				  if($test_val['order_type']=="api"){
				$commission = $this->get_prise_vise_commision($test_val['product_prise']);
				$commision = ((float) $test_val['product_prise']*(int) $commission)/100;
                $unbilled_amount_array_prise[] = $commision;
				  $productWithCatPriseArray[$key]['commission'] =  $commision;
				   $productWithCatPriseArray[$key]['taxes'] = 15;
				   $productWithCatPriseArray[$key]['delivery_charges'] = $this->shippingCalculator($test_val); 
				  }else{
					  $user_sale_array_data[] = (float) $test_val['product_prise'];
					   $productWithCatPriseArray[$key]['commission'] =  0;
					    $productWithCatPriseArray[$key]['taxes'] = 0;
						$productWithCatPriseArray[$key]['delivery_charges'] =  $this->shippingCalculator($test_val);
					  }
			  //}
		 
		}
		
		
	
	}
	
	return $productWithCatPriseArray;
    }
	
private function calculate_unbiled_amout_function($commitionArray , $productWithCatPriseArray ){
	$unbilled_amount_array_ctatagory = array();
	$unbilled_amount_array_prise = array();
	$user_sale_array_data = array();
	$total_unbilled_commisttion = array();
	$new_modified_array = array();
	//dd($productWithCatPriseArray,$commitionArray);
	foreach($productWithCatPriseArray as $key => $test_val){
		
		  
		  $commission_category  = array();
		  $mycommision = array();
		  foreach($commitionArray as $comm_val){
			  $commission_category[] = $comm_val['cat_id'];
			  $mycommision[$comm_val['cat_id']] = $comm_val['commision_value'];
			
		  }
		  if(in_array($test_val['procut_cat_id'], $commission_category)){
			  if($test_val['order_type']=="api"){
			   $commision = ((float) $test_val['product_prise']*(int) $mycommision[$test_val['procut_cat_id']])/100;
    		   $unbilled_amount_array_ctatagory[] = $commision; 
			    
			  }else{
				  $user_sale_array_data[] = (float) $test_val['product_prise'];
				   
				  }
		  }else{
			  //if($this->get_prise_vise_commision($test_val['product_prise']) != NULL){
				 // dd($test_val['product_prise']);
				// dd($test_val['product_prise']);
				  if($test_val['order_type']=="api"){
				$commission = $this->get_prise_vise_commision($test_val['product_prise']);
				$commision = ((float) $test_val['product_prise']*(int) $commission)/100;
                $unbilled_amount_array_prise[] = $commision;
				  
				  }else{
					  $user_sale_array_data[] = (float) $test_val['product_prise'];
					 
					  }
			  //}
		 
		}
		
		
	
	}
	$tota_cat_cum = $this->add($unbilled_amount_array_ctatagory);
	$tota_prise_cum = $this->add($unbilled_amount_array_prise);
	$final_unbilled_amount  = $tota_cat_cum + $tota_prise_cum;
	$user_product_prise = $this->add($user_sale_array_data);
	$final_amount_after_tax = (float) $final_unbilled_amount - ((float)$final_unbilled_amount * $this->tax )/100;
	
	$unbilled_amount_array_ctatagory = $final_amount_after_tax+$user_product_prise;
	
	//$data =  $this->shippingCalculator($productWithCatPriseArray);
     //return $final_amount_after_tax;
	return $unbilled_amount_array_ctatagory;
    }
	
private function add($arrayVal){
	$amount=0;
	foreach ($arrayVal as $val){
		//dd($val);
		$amount =(float) $amount + (float) $val;
		
		}
	
	
return $amount;	
	}
	
private function get_prise_vise_commision($prise){
	//dd($prise);
	$get_data_from_table = Standerd_commision::all();
 	foreach($get_data_from_table as $val){
		
		if( (int) $prise >= (int)$val->min_price && (int)$prise <= (int)$val->max_price ){
			//dd($prise);
			return $val->commission;
			}
		    
		}
	}
    }



















