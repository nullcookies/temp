<?php 
namespace App\Http\Controllers\Admin\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User, DB, Redirect, Image, Response;
/**
* Helper Class for product
*/
class ProductHelper extends Controller
{
	
	
	public function deleteProductImage($productid)
	{
		$error = 0;
		if(!$productid)	{
			$error = 1;
		}

		if($error){
            return redirect(ADMIN_URL_PATH.'/product');
            exit;
        }
		$productImage = \DB::table('product_images')->where('id',$productid);
		dd($productImage);
		$dim10                          =   '10x10';
        $dim20                          =   '20x20';
        $dim50                          =   '50x50';
        $dim100                         =   '100x100';
        $dim200                         =   '200x200';
        $dim300                         =   '300x300';
        $dim500                         =   '500x500';
        $imageDir						= 	'product_images';
		foreach ($productImage as $key => $image) {
			$file       = $image->image;
	        \File::delete(public_path().'/' . $imageDir . '/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim10.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim20.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim50.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim100.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim200.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim300.'/'.$file);
	        \File::delete(public_path().'/' . $imageDir . '/'.$dim500.'/'.$file);
	        $deleted    = \DB::table('product_images')->where('id', $image->id)->delete();
		}
		return $deleted;
	}
	/* Jaymani Delete Product Image*/
	public function productImageDelete($id)
	{
		$images      = \DB::table('product_images')->where('product_id', $id)->get();
		$dim10                          =   '10x10';
        $dim20                          =   '20x20';
        $dim50                          =   '50x50';
        $dim100                         =   '100x100';
        $dim200                         =   '200x200';
        $dim300                         =   '300x300';
        $dim500                         =   '500x500';  

		//dd($id, $image);
		foreach($images as $image){
			$file       = $image->image;
	        \File::delete(public_path().'/product_images/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim10.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim20.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim50.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim100.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim200.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim300.'/'.$file);
	        \File::delete(public_path().'/product_images/'.$dim500.'/'.$file);
		}
        $deleted    = \DB::table('product_images')->where('product_id', $id)->delete();
        return $deleted;
	}	

	public function uploadMultipleImages(){
		return view('admin/product/upload_images');
	}

	public function saveMultipleImages(Request $request){
		if(!$request->ajax()){
            exit;
        }

        if($request->hasFile('image')){
            $destination = public_path().'/product_images';

            $dim10                          =   '10x10';
            $dim20                          =   '20x20';
            $dim50                          =   '50x50';
            $dim100                         =   '100x100';
            $dim200                         =   '200x200';
            $dim300                         =   '300x300';
            $dim500                         =   '500x500';

            $image_url                      =   '';
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

            $image       = $request->file('image');
            $filename    = uniqid().time().'.'.$image->getClientOriginalExtension();

            if($image->move($destination, $filename)){
                $uploaded                   =   $destination.'/'.$filename ;
                Image::make($uploaded)->resize(10, 10)->save($destination.'/'.$dim10.'/'.$filename);
                Image::make($uploaded)->resize(20, 20)->save($destination.'/'.$dim20.'/'.$filename);
                Image::make($uploaded)->resize(50, 50)->save($destination.'/'.$dim50.'/'.$filename);
                Image::make($uploaded)->resize(100, 100)->save($destination.'/'.$dim100.'/'.$filename);
                Image::make($uploaded)->resize(200, 200)->save($destination.'/'.$dim200.'/'.$filename);
                Image::make($uploaded)->resize(300, 300)->save($destination.'/'.$dim300.'/'.$filename);
                Image::make($uploaded)->resize(500, 500)->save($destination.'/'.$dim500.'/'.$filename);
                
                $image_url = url('product_images/'.$filename);
            }
        }

        return Response::json(array('success' => 'true','image_url' => $filename ));
	}
}

 ?>