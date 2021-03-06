<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'banner';
    protected $primary_key = 'id';
	protected $fillable = array(
		'id',
		'cid',
		'image',
		'link',
		'status',
	);
	public $timestamps = false;	
	public $category = [
			['id' => 1, 'name' => 'Logo', 'dim' => '200x50'],
			['id' => 2, 'name' => 'Main Slider Images', 'dim' => '600x462'], 
			['id' => 3, 'name' => 'Right 1 Image', 'dim' => '285x500'], 
			['id' => 4, 'name' => 'Right 2 Image', 'dim' => '285x383'], 
			['id' => 5, 'name' => 'Right 3 Image', 'dim' => '285x235'], 
			['id' => 6, 'name' => 'Content Strip Image', 'dim' => '1280x117'],			
		];

	public function updateImage($id, $image)
	{
		 $result = Banners::where('id', $id)->update(['image' => $image]);        
        return $result;
	}
	public function createOrUpdateImage($cid,$imageurl,$image)
	{

		$imageSrc = Banners::select(['image'])->where('cid', $cid)->first();                
        $oldImage = isset($imageSrc->image) ? $imageSrc->image : '';
        if(!empty($image))
        {
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path('product_images/banners/'), $imageName);
	        if(!empty($oldImage) && is_file(public_path('product_images/banners/').$oldImage)){
	            unlink(public_path('product_images/banners/').$oldImage);
	        }
        }             
        $update = Banners::updateOrCreate(['cid' => $cid])->update(['image' => $imageName, 'cid' => $cid, 'link' => $imageurl]);
        return ['update'=> $update];
	}
	public function addSlider($cid,$imageurl,$image)
	{
		if(!empty($image))
        {
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path('product_images/banners/'), $imageName);
        } 
		$result = Banners::insertGetId([
			'cid' 		=> $cid,
			'image' 	=> $imageName,
			'link' 		=> $imageurl,
			'status' 	=> 1
		]);
		/* Image Crop Code*/
        $dimension = '';
        foreach($this->category as $catData){
        	if($catData['id'] == $cid){
        		$dimension = $catData['dim'];
        	}
        }

        $dimensionArr = explode('x', $dimension);

        $width = '300';
        $height = '300';

        if(sizeof($dimensionArr)){
        	$width = $dimensionArr[0];
       		$height =$dimensionArr[1];
        }

        $w = $width;
        $h = $height;
        $imgpath = 'product_images/banners';
        $img = $imageName;
        /* Image Crop  */
        return ['update'=> $result, 'w'=> $w,'h' => $h,'img' => $img, 'imgpath' => $imgpath];		
	}
}
