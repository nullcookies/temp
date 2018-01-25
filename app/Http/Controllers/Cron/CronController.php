<?php

namespace App\Http\Controllers\Cron;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller, DB, Image;

class CronController extends Controller{
    
    public $product_image_destination;
    public $product_image_dir;

    public function __construct(){
    	$this->product_image_dir 		 = 'product_images';
    	$this->product_image_destination = public_path($this->product_image_dir);
    }

    public function fetchBulkProductImages(Request $request){

    	$recoards 		=	DB::table('pending_product_image')->where('fetched','no')->get();

    	foreach ($recoards as $recoard) {
    		$url 		=	$recoard->image_url;
    		
    		$fetchImage =	self::get_data($url, $this->product_image_destination);
    		if(!$fetchImage){
    			continue;
    		}

            if(filesize($this->product_image_destination.'/'.$fetchImage) == 0){
                unlink($this->product_image_destination.'/'.$fetchImage);
                continue;
            }

    		$extension   =  pathinfo($fetchImage, PATHINFO_EXTENSION);

    		if(!in_array($extension, ['jpg','jpeg','png'])){
    			DB::table('pending_product_image')->where('id',$recoard->id)->delete();
    			continue;
    		}

    		$assignImage =	DB::table('product_images')->insert(array('image' => $fetchImage, 'default_image' => 'yes', 'product_id' => $recoard->product_id));
    		
    		if($assignImage){
    			self::cropImages($fetchImage);
    			DB::table('pending_product_image')->where('id',$recoard->id)->update(array('fetched' => 'yes'));
    		}
    	}
    	echo 'All Images Fetched';
    	exit;
    }

    public function cropImages($filename){
    		$destination = $this->product_image_destination;

    		$sourceImage = $destination.'/'.$filename;

            $dim10                          =   '10x10';
            $dim20                          =   '20x20';
            $dim50                          =   '50x50';
            $dim100                         =   '100x100';
            $dim200                         =   '200x200';
            $dim300                         =   '300x300';
            $dim500                         =   '500x500';


            if(!file_exists($destination)){
                mkdir($destination);
            }

            if(!file_exists($destination.'/'.$dim10)){
                mkdir($destination.'/'.$dim10);
            }

            if(!file_exists($destination.'/'.$dim20)){
                mkdir($destination.'/'.$dim20);
            }

            if(!file_exists($destination.'/'.$dim50)){
                mkdir($destination.'/'.$dim50);
            }

            if(!file_exists($destination.'/'.$dim100)){
                mkdir($destination.'/'.$dim100);
            }

            if(!file_exists($destination.'/'.$dim200)){
                mkdir($destination.'/'.$dim200);
            }

            if(!file_exists($destination.'/'.$dim300)){
                mkdir($destination.'/'.$dim300);
            }

            
            if(!file_exists($destination.'/'.$dim500)){
                mkdir($destination.'/'.$dim500);
            }

            Image::make($sourceImage)->resize(10, 10)->save($destination.'/'.$dim10.'/'.$filename);
            Image::make($sourceImage)->resize(20, 20)->save($destination.'/'.$dim20.'/'.$filename);
            Image::make($sourceImage)->resize(50, 50)->save($destination.'/'.$dim50.'/'.$filename);
            Image::make($sourceImage)->resize(100, 100)->save($destination.'/'.$dim100.'/'.$filename);
            Image::make($sourceImage)->resize(200, 200)->save($destination.'/'.$dim200.'/'.$filename);
            Image::make($sourceImage)->resize(300, 300)->save($destination.'/'.$dim300.'/'.$filename);
            Image::make($sourceImage)->resize(500, 500)->save($destination.'/'.$dim500.'/'.$filename);

    }

    public static function get_data($url, $file_destination) {  // download the file from external url and return the path string

		$source = $url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSLVERSION,3);
		$data = curl_exec ($ch);
		$error = curl_error($ch); 
		curl_close ($ch);
		$extension 	 = pathinfo($source, PATHINFO_EXTENSION);

        if(is_null($extension)){
            return false;
            exit;
        }

		$file_name   = time();
		$destination = $file_destination.'/'.$file_name.'.'.$extension;
        $file = fopen($destination, "w+");
		
        if($data){
			fputs($file, $data);
		}
		
		fclose($file);

		if(file_exists($file_destination.'/'.$file_name.'.'.$extension)){
		    return $file_name.'.'.$extension;
		}else{
			return false;
		}

	}
}
