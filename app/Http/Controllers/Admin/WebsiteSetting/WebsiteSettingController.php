<?php 
namespace App\Http\Controllers\Admin\WebsiteSetting;
use Illuminate\Http\Request;
use App\Models\Banners\Banners;
use App\Http\Requests;
use App\Http\Requests\Admin\Banners\BannerRequest;
use App\Http\Controllers\Controller, DB, Session, Redirect, Response;
use App\Models\Socialmedia, File;
use App\Models\Product\HomepageHotDeal;
use App\Models\Product\HomepageTagProduct;
use App\Models\Pages\Testimonials, Image;
use App\Models\Checklist\CheckList;

class WebsiteSettingController extends Controller
{
	private $data;
	function __construct(Banners $bannerObj) {
		$this->bannerObj = $bannerObj;
	}
	public function index()
	{
		$obj = new Banners;
		$data['title']				= 'Website Setting';
		$data['category']			= $all_categories = $obj->category;
		$data['logo'] 				= Banners::where('cid', 1)->first();
		$data['mainslider'] 		= Banners::where('cid', 2)->get();
		$data['right1'] 			= Banners::where('cid', 3)->first();
		$data['right2'] 			= Banners::where('cid', 4)->first();
		$data['right3'] 			= Banners::where('cid', 5)->first();
		$data['contentstrip'] 		= Banners::where('cid', 6)->first();
        $data['logo']['dim']        = $this->getdimention(1);
        $data['mainslider_dim']     = $this->getdimention(2);
        $data['right1']['dim']      = $this->getdimention(3);
        $data['right2']['dim']      = $this->getdimention(4);
        $data['right3']['dim']      = $this->getdimention(5);
		$data['contentstrip']['dim']= $this->getdimention(6);
        //dd($data['mainslider']);
        
        $checklist = CheckList::first() ? CheckList::first() : new CheckList;
        $checklist->manage_homepage_checked = 'yes';
        $checklist->save();
        
		return view ('admin/website/setting', $data);
	}	
	public function add()
	{
		$obj = new Banners;
		$data['title']				= 'Add Banner Images'; unset($obj->category[1]);
		$data['category']			= $obj->category;        
		return view ('admin/website/add', $data);
	}
	public function updateImage(BannerRequest $request)
	{
        if(!$request->all()){
            die("Bad Request");
        } 
        
        $checklist = CheckList::first() ? CheckList::first() : new CheckList;
        $checklist->upload_logo_checked = 'yes';
        $checklist->save();
        $data[] = '';
        $data   = $this->bannerImage($request);
        //dd($data);
        return view ('admin/jcrop/imageform', $data);        		        
	}
	public function sliders()
	{
		$obj = new Banners;
		$data['title']				= 'Add Banner Slider Images';
		$data['category']			= $obj->category;	 
		return view ('admin/website/sliders', $data);
	}
	public function updateSliders(BannerRequest $request)
	{
		//dd($request->all());
		if(!$request->all()){
            die("Bad Request");
        }
        $data[] = '';
        $data   = $this->bannerImage($request);
        //dd($data);
        return view ('admin/jcrop/imageform', $data);
    }

    /* Social Media Controller*/

    public function addsocial()
    {
        return view('admin.socialmedia.create');
    }
    public function postsocial(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'slug' => 'required|alpha_dash|unique:socialmedia',
            'link' => 'required|url'
        ]);
        Socialmedia::create($request->all());
        return redirect('admin/socialmedia')
                        ->with('success','Record created successfully');
    }
    public function editsocial($id)
    {
        $item = Socialmedia::find($id);
        return view('admin.socialmedia.edit',compact('item'));
    }
    public function updateocial(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'slug' => 'required|alpha_dash|unique:socialmedia,slug,'.$id,
            'link' => 'required|url'
        ]);
        Socialmedia::find($id)->update($request->all());
        return redirect('admin/socialmedia')
                        ->with('success','Record updated successfully');
    }
    public function showlist(Request $request)
    {
        $items = Socialmedia::orderBy('id','DESC')->paginate(10);
        return view('admin.socialmedia.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function deletesocial(Request $request)
    {        
        Socialmedia::find($request->id)->delete();
        return redirect('admin/socialmedia')
                        ->with('success','Record deleted successfully');
    }

	public function imagedelete(Request $request)
    {
        $bannerImage = Banners::find($request->id);        
        $bannerImage->delete();
        if(!empty($bannerImage->image) && is_file(public_path('product_images/banners/').$bannerImage->image)){
            unlink(public_path('product_images/banners/').$bannerImage->image);
        }
        return response()->json(['danger'=>'Images Deleted !!.', 'id'=>$request->id]);
    }	
   /* public function postjcrop(Request $request){
        $data           = [];
        $data['x']      = $request->x;
        $data['y']      = $request->y;
        $data['w']      = $request->w;
        $data['h']      = $request->h;
        $data['folder']      = $request->imgpath;
        $data['img']    = $request->img;
        $data['backlink']    = $request->backlink;
        //dd($data);
        return view('admin/jcrop/imageform',$data);
    }*/
    function base64ToImage($base64_string,$imgname,$output_file) {
        $img = $base64_string;
        $img = str_replace('data:image/png;base64,', '', $img);
        
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = public_path($output_file).'/'.$imgname;
        $success = file_put_contents($file, $data);
        $imginfo = getimagesize($file);
        $width  = $imginfo[0];
        $height = $imginfo[1];
        if($success){
            Image::make($file)->resize($width, $height)->save($file);
        }
        return $success  ? true : false;
    }
    public function savejcrop(Request $request){
        //dd($request->all());
        if($request->has('imgdata') && $request->has('imagename') && $request->has('path')){
            $image  = $this->base64ToImage($request->imgdata,$request->imagename,$request->path); 
            if(isset($request->cid)){
                if($request->cid == 2) {
                $update = Banners::insertGetId([
                            'cid'       => $request->cid,
                            'image'     => $request->imagename,
                            'link'      => $request->link,
                            'status'    => 1
                        ]);
                }else{
                    $update = Banners::updateOrCreate(['cid' => $request->cid])->update(['image' => $request->imagename, 'cid' => $request->cid, 'link' => $request->imageurl]);
                }
            }
        }
        if(isset($request->productImage)){
            if($request->id){
                $update = HomepageHotDeal::where('id', $request->id)->update([
                        'name'      => $request->name,
                        'rating'    => $request->rating,
                        'old_price' => $request->old_price,
                        'new_price' => $request->new_price,
                        'start_date' => $request->start_date,
                        'end_date'   => $request->end_date,
                        'link'      => $request->link,            
                        'image'     => $request->imagename
                        ]);
            }else{
               $update = HomepageHotDeal::insertGetId([ 
                            'name'      => $request->name,
                            'rating'    => $request->rating,
                            'old_price' => $request->old_price,
                            'new_price' => $request->new_price,
                            'start_date' => $request->start_date,
                            'end_date'   => $request->end_date, 
                            'link'      => $request->link,
                            'image'     => $request->imagename
                        ]);
            }
            
        }
        if(isset($request->products)){
            if($request->id){
                $update = HomepageTagProduct::where('id', $request->id)->update([
                        'name'      => $request->name,
                        'tagid'     => $request->tagid,
                        'rating'    => $request->rating,
                        'old_price' => $request->old_price,
                        'new_price' => $request->new_price,                        
                        'link'      => $request->link,            
                        'image'     => $request->imagename
                        ]);
            }else{
               $update = HomepageTagProduct::insertGetId([ 
                            'name'      => $request->name,
                            'tagid'     => $request->tagid,
                            'rating'    => $request->rating,
                            'old_price' => $request->old_price,
                            'new_price' => $request->new_price,                        
                            'link'      => $request->link,            
                            'image'     => $request->imagename
                        ]);
            }
            
        }
        if(isset($request->testimonials)){
            $string_content = urldecode($request->content);
            
           if($request->id){
                $update = Testimonials::where('id', $request->id)->update([
                        'name'          => $request->name,
                        'designation'   => $request->designation,
                        'content'       => $request->content,
                        'status'        => $request->status,                              
                        'image'         => $request->imagename
                        ]);
            }else{
               $update = Testimonials::insertGetId([ 
                        'name'          => $request->name,
                        'designation'   => $request->designation,
                        'content'       => $request->content,
                        'status'        => $request->status,                              
                        'image'         => $request->imagename
                        ]);
            }
        }

        if($update){
            return Response::json(array('path' => url('admin/homepage')));
        } 
        exit;
    }
    public function getdimention($cid)
    {
        $all_categories = $this->bannerObj->category;        
        $dimension    = '';
        foreach($all_categories as $mycategory){
            if($mycategory['id'] == $cid){
                $dimension  = $mycategory['dim'];
                break;
            }
        }
        $dimension = explode('x', $dimension);
        return ['width' => $dimension[0], 'height' => $dimension[1]];
    }
    public function bannerImage($request)
    {
        $data[] = '';
        $obj = new Banners;
        $categories = $obj->category;
        $cid    = $request->category;
        $imageName = '';
        $imageurl      = $request->link;        
        if($request->hasFile('image')){
            /* Image Crop Code*/
            $image  = $request->file('image');
            $dimension = '';
            foreach($categories as $catData){
                if($catData['id'] == $cid){
                    $dimension = $catData['dim'];
                }
            }

            $dimensionArr = explode('x', $dimension);
            $width = '100';
            $height = '100';

            if(sizeof($dimensionArr)){
                $width = $dimensionArr[0];
                $height =$dimensionArr[1];
            }

            $w = $width;
            $h = $height;
            
            $imgpath = 'product_images/banners';   
            $imageSrc = Banners::select(['image'])->where('cid', $cid)->first();                
            $oldImage = isset($imageSrc->image) ? $imageSrc->image : '';                
            if(!empty($image))
            {
                $imageName = time() . '.' . $image->getClientOriginalExtension();           
                $image->move(public_path('product_images/banners/img/'), $imageName);

                if(($cid != 2) && !empty($oldImage) && is_file(public_path('product_images/banners/img/').$oldImage)){
                    unlink(public_path('product_images/banners/img/').$oldImage);
                }
                if(($cid != 2) && !empty($oldImage) && is_file(public_path('product_images/banners/').$oldImage)){
                    unlink(public_path('product_images/banners/').$oldImage);
                }
            } 
            /* Image Crop  */  
            $data['cid']        = $cid;
            $data['w']          = $w;
            $data['h']          = $h;
            $data['imgpath']    = $imgpath;
            $data['img']        = $imageName;
            $data['link']       = $request->link;
        }
        return $data;
    }
}
?>