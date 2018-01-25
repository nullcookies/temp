<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Excel, DB;

class TestController extends Controller{
    
    public $data;

    public function __construct(){
    	$this->data 		=	array();
    }

    public function getCategory(Request $request){

    	$categories 		=	array();

    	if($request->has('cid')){
    		$allCategories 	=	self::getAllCategories();
    		$childs 		=	self::getChildFromArray($request->cid, $allCategories);
    		$categories 	=	$childs ;
    	}

    	$this->data['categories']	=	$categories;
    	return view('demo/index', $this->data);
    }

    public function getAllCategories(){
    	$categories 	    =   Category::select('id','category','status','parentId')->get();
		if(!$categories){
			echo 'category not exist';
			exit;
		}
		$carArr 		=	array();
		foreach($categories as $category){
			$carArr[]	=	array('id' => $category->id, 'name' => $category->category, 'status' => $category->status, 'parentId' => $category->parentId);
		}

		return $carArr;		
    }

    public function getChildFromArray($category_id, $allCategories){

    	$childs 		=	array();
    	foreach($allCategories as $key => $category){
    		if($category['parentId'] != $category_id){
    			continue;
    		}

    		$childs[]				=	$category;
    		$childs[count($childs)-1]['childs'] 	=	self::getChildFromArray($category['id'], $allCategories);
    	}

    	return $childs;
    }
    
    public function uploadVarients(Request $request){
        return view('massengers/uploadVar');
    }
    
    public function saveVarients(Request $request){
        if(!$request->hasFile('excel')):
            exit;
        endif;
        
        $file                       =   $request->file('excel')->getRealPath();
        
        $data = Excel::load($file, function($reader) {                
            })->get(); 
            
        dd($data);
        /*$excelData = Excel::selectSheets('td')->load($file->getRealPath(), function($render){ 
            $render->each(function($row){
                DB::table('pincodes')->insert(array('zone_id' => 1, 'pincode' => $row->pincode, 'city_name' => $row->city,  'cod_available' => 'yes', ));
            });
        })->get();*/
    }
}
