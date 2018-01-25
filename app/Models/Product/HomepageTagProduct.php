<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class HomepageTagProduct extends Model
{
    protected $table = 'homepage_tag_product';
    protected $primary_key = 'id';
	protected $fillable = ['id','tagid','name','image','old_price','new_price','rating','link'];
	public $timestamps = true;

	public static function createOrUpdateImage($id,$image){
		$imageSrc = HomepageTagProduct::select(['image'])->where('id', $id)->first();                
        $oldImage = isset($imageSrc->image) ? $imageSrc->image : '';
        if(!empty($image))
        {
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path('products-images/'), $imageName);
	        if(!empty($oldImage) && is_file(public_path('products-images/').$oldImage)){
	            unlink(public_path('products-images/').$oldImage);
	        }
        }        
        return $imageName;
	}
	public static function productImage($request, $id){
		$data[] = '';
		$width = '300';
        $height = '300';
        $w = $width;
        $h = $height;
        $imgpath = 'products-images';
        $imageName = '';
        $imageSrc = ($id) ? HomepageTagProduct::where('id', $id)->first() : '';                    
        $oldImage = $imageName = isset($imageSrc->image) ? $imageSrc->image : '';

        if($request->hasFile('image'))
        {
        	$image = $request->file('image');
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path('products-images/img/'), $imageName);
	        if(!empty($oldImage) && is_file(public_path('products-images/img/').$oldImage)){
	            unlink(public_path('products-images/img/').$oldImage);
	        }
	        if(!empty($oldImage) && is_file(public_path('products-images/').$oldImage)){
	            unlink(public_path('products-images/').$oldImage);
	        }
        }        
        $data = [
        	'products' => 1,
            'tagid' => $request->tagid,
        	'id' => $id,
        	'w'  => $w,
        	'h'  => $h,
        	'name' => $request->name,
        	'imgpath'  => $imgpath,
        	'img'  => $imageName,
        	'link'  => $request->link,
        	'rating' => $request->rating,
        	'old_price' => $request->old_price,
        	'new_price' => $request->new_price,        	
        ];  
		//dd($data);
        return $data;
	}
}
