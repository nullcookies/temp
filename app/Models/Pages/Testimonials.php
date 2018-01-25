<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;
use File;
class Testimonials extends Model
{
    protected $table = 'testimonial';
    protected $primary_key = 'id';
	protected $fillable = ['id','name','designation','content','status','image'];
	public $timestamps = true;

	public static function productImage($request, $id){
		$data[] = '';
		$width = '200';
        $height = '200';
        $w = $width;
        $h = $height;
        $imgpath = 'testimonials';
        $imageName = '';
        $imageSrc = ($id) ? Testimonials::where('id', $id)->first() : '';                    
        $oldImage = $imageName = isset($imageSrc->image) ? $imageSrc->image : '';

        if($request->hasFile('image'))
        {
        	$image = $request->file('image');
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path($imgpath.'/img/'), $imageName);
	        if(!empty($oldImage) && is_file(public_path($imgpath.'/img/').$oldImage)){
	            unlink(public_path($imgpath.'/img/').$oldImage);
	        }
	        if(!empty($oldImage) && is_file(public_path($imgpath.'/').$oldImage)){
	            unlink(public_path($imgpath.'/').$oldImage);
	        }
        }        
        $data = $request->all();  
        $data['w'] = $width;
        $data['h'] = $height;
        $data['folder'] = $imgpath;
        $data['img'] = $imageName;        
        $data['id'] = $id;        
        $data['backlink'] = route('admin.testimonials.index',$id);        
		//dd($data);
        return $data;
	}

	/*public static function cropimages($image,$width,$height,$folder){
		if(!empty($image))
        {
        	$imageName = time() . '.' . $image->getClientOriginalExtension();        	
	        $image->move(public_path($folder, $imageName);
	        if(!empty($oldImage) && is_file($folder.$oldImage)){
	            unlink($folder.$oldImage);
	        }
        } 


        $w  = (int)$width;
        $h  = (int)$height;
        $image_folder  = $folder;        
        $jpeg_quality = 90;
        $name = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path($image_folder.'\\'.$name);
        $image->move($path, $name);
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        dd($path);

        if(File::exists($path)){
            unlink($path);
        }

        $targ_w = $w;
        $targ_h = $h;        
        $src = $path;
        $dst_r = imagecreatetruecolor($targ_w, $targ_h);
         //dd($dst_r,$path,$jpeg_quality,$ext);
        switch($ext)
        {
            case 'jpg' :    $img_r = imagecreatefromjpeg($src);                                                   
                            imagecopyresampled($dst_r,$img_r,0,0,0,0,$w,$h,$targ_w,$targ_h);                            
                            header('Content-type: image/jpeg'); 
                            imagejpeg($dst_r,$path,$jpeg_quality);
                            break;
            case 'png' :    //dd(url($src))      ;                      
                            $img_r = imagecreatefrompng($src);
                            imagealphablending($dst_r, false);
                            $white = imagecolorallocatealpha($dst_r, 0, 0, 0, 127);    //FOR WHITE BACKGROUND
                            imagefilledrectangle($dst_r,0,0,$targ_w, $targ_h,$white);
                            imagesavealpha($dst_r, true);
                            $userImage = imagecopyresampled($dst_r,$img_r,0,0,0,0,$w,$h,$targ_w,$targ_h);
                            header('Content-type: image/png');
                            imagepng($dst_r,$path,9);                             
                            break;
        }
                
        return $name;

    }*/
}
