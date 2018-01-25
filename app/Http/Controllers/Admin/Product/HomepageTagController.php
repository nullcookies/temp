<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product\HomepageTag;
use App\Models\Product\HomepageTagProduct;
use App\Models\Product\HomepageHotDeal;
use Carbon\Carbon;
class HomepageTagController extends Controller
{

    public function index(Request $request)
    {
        $items = HomepageTag::orderBy('id','DESC')->paginate(10);
        return view('admin.product.homepagetag.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.product.homepagetag.create');
    }

 
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required',
        ]);
        HomepageTag::create($request->all());
        return redirect()->route('admin.product.homepagetag.index')
                        ->with('success','Tag created successfully');
    }
    
    public function edit($id)
    {
        $item = HomepageTag::find($id);
        return view('admin.product.homepagetag.edit',compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tag' => 'required',
        ]);
        HomepageTag::find($id)->update($request->all());
        return redirect()->route('admin.product.homepagetag.index')
                        ->with('success','Tag updated successfully');
    }

    public function destroy($id)
    {
        HomepageTag::find($id)->delete();
        return redirect()->route('admin.product.homepagetag.index')
                        ->with('success','Item deleted successfully');
    }
    
    /* Products */
    public function show(Request $request, $id)
    {
        //dd($id);
        $item = HomepageTag::find($id);
        $products = HomepageTagProduct::where('tagid',$item->id)->orderBy('id','DESC')->paginate(10);
        //dd($item->toArray());
        return view('admin.product.homepagetag.show',compact('item', 'products'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function addTagProducts(Request $request)
    {
        $item = HomepageTag::find($request->id);
        return view('admin.product.homepagetag.addTagProducts', compact('item'));
    }
    public function postTagProducts(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'rating' => 'required',
            'image'  => 'required|image|mimes:jpeg,png,jpg|max:2056',
            'link'    => 'required|url',
            'old_price' => 'required|numeric',
            'new_price' => 'required|numeric',
        ]);             
        $data[] = '';
        $data   = HomepageTagProduct::productImage($request, $id='');
        //dd($data);
        return view ('admin/jcrop/imageform', $data);        
    }
    public function editTagProducts($id)
    {
        $item = HomepageTagProduct::find($id);
        return view('admin.product.homepagetag.editTagProducts',compact('item'));
    }
    public function updateTagProducts(Request $request, $id)
    {        
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'rating' => 'required',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2056',
            'link'    => 'url',
            'old_price' => 'required|numeric',
            'new_price' => 'required|numeric',
            
        ]);
        if(!$request->hasFile('image'))
        {
            if($request->id){ 
                $update = HomepageTagProduct::where('id', $request->id)->update([
                        'name'      => $request->name,
                        'tagid'     => $request->tagid,
                        'rating'    => $request->rating,
                        'old_price' => $request->old_price,
                        'new_price' => $request->new_price,                        
                        'link'      => $request->link,            
                        'image'     => $request->imageSrc
                        ]);
            }           
            return redirect()->to('admin/product/homepagetag/'.$request->tagid)
            ->with('success','Product updated successfully');
        }else{
            $data[] = '';
            $data   = HomepageTagProduct::productImage($request, $id);
            return view ('admin/jcrop/imageform', $data); 
        }   
    }
    public function deleteTagProducts($id)
    {
        $result = HomepageTagProduct::find($id);
        $oldImage = $result->image;
        $result->delete();
        if(!empty($oldImage) && is_file(public_path('products-images/').$oldImage)){
            unlink(public_path('products-images/').$oldImage);
        }    

        return back()->with('success','Item deleted successfully');
    }
    public function producthotdeal(Request $request)
    {
        $items = HomepageHotDeal::orderBy('id','DESC')->paginate(10);
        return view('admin.product.producthotdeal.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function producthotdealcreate()
    {
        return view('admin.product.producthotdeal.create');
    }

 
    public function producthotdealstore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'rating' => 'required',
            'image'  => 'required|image|mimes:jpeg,png,jpg',
            'link'    => 'required|url',
            'old_price' => 'required|numeric',
            'new_price' => 'required|numeric',
            'daterange'  => 'required',
        ]);             
        $data[] = '';
        $data   = HomepageHotDeal::productImage($request, $id='');
        //dd($data);
        return view ('admin/jcrop/imageform', $data);
    }
    public function producthotdealedit($id)
    {
        $item = HomepageHotDeal::find($id);
        return view('admin.product.producthotdeal.edit',compact('item'));
    }

    public function producthotdealupdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'rating' => 'required',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2056',
            'link'    => 'url',
            'old_price' => 'required|numeric',
            'new_price' => 'required|numeric',
            'daterange'  => 'required',
        ]);          
        if(!$request->hasFile('image'))
        {
            if($request->id){
                $daterange = explode(' - ', $request->daterange);
                $update = HomepageHotDeal::where('id', $request->id)->update([
                        'name'      => $request->name,
                        'rating'    => $request->rating,
                        'old_price' => $request->old_price,
                        'new_price' => $request->new_price,
                        'start_date' => $daterange[0],
                        'end_date'   => $daterange[1],
                        'link'      => $request->link,            
                        'image'     => $request->imageSrc
                        ]);
            }          
            return redirect()->to('admin/product/product-hot-deal')
            ->with('success','Product updated successfully');
        }else{
            $data[] = '';
            $data   = HomepageHotDeal::productImage($request, $id);        
            return view ('admin/jcrop/imageform', $data); 
        }
    }
    public function producthotdealdestroy($id)
    {
        $result = HomepageHotDeal::find($id);
        $oldImage = $result->image;
        $result->delete();
        if(!empty($oldImage) && is_file(public_path('products-images/').$oldImage)){
            unlink(public_path('products-images/').$oldImage);
        }    
        return back()->with('success','Item deleted successfully');
    }
}
