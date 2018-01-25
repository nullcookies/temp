<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB,Auth,Session,Response,Redirect;
class Category extends Model
{
    protected $table = 'category';
	protected $fillable = ['id','category','parentId','status','varient','recordInsertedBy','recordInsertDate','sort_order','name_alias','flag'];
	public $timestamps = true;	

	public function usethis(){
		echo 'this is method';
	}
	
	public function banner(){
	    return $this->hasOne('App\CategoryBanner', 'categoryid');
	}
	public function getAllChild($catid,$layer = 1){

    	$childs 		=	array();
    	$myallCat		=	array();
    	$categories 	=	DB::table('category')->where('parentId',$catid)->select('id','category','parentId','flag')->get();
  
    	foreach($categories as $key => $category){    		
    		$childs[$key]['id']			=	$category->id;
    		$childs[$key]['category']	=	$category->category;
            $childs[$key]['flag']       =   $category->flag;           
            if($layer < 2){
            	$layer ++;
            	$childs[$key]['child']		=	self::getAllChild($category->id,$layer);            	
            }else{
            	$childs[$key]['child'] = [];
            }
    		    		
    	}

    	return $childs;
    }
    public static function apiCategoriesAll(){       
        $url        =   "http://seller.digishoppers.com/webservice/category/A123456";
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result= curl_exec($ch);
        if(!$result){
            return false;
            exit;
        }
        
        curl_close($ch);

        if(json_decode($result, true)['error']){
            return false;
            exit;
        }
        return json_decode($result, true)['data'];
    }

}
