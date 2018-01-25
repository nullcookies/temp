<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages\Testimonials;

class TestimonialsController extends Controller
{
    
    public function index(Request $request)
    {
        $items = Testimonials::orderBy('id')->paginate(10);

        return view('admin.testimonials.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    
    public function create()
    {
        return view('admin.testimonials.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'designation' => 'required',
            'image'  => 'required|image|mimes:jpeg,png,jpg|max:2056',
        ]);
        //dd($request->all());
        $request['alias'] = substr(str_replace(' ','',strtolower($request->name)), 0, 10);        
        $data[] = '';
        $data   = Testimonials::productImage($request, $id);
        //dd($data);
        return view ('admin/jcrop/imagecrop', $data); 
        /*Testimonials::create($request->all());
        return redirect()->route('admin.testimonials.index')
                        ->with('success','Record created successfully');*/
    }

   
    public function show($id)
    {
        $item = Testimonials::find($id);
        return view('admin.pages.edit',compact('item'));
    }

    
    public function edit($id)
    {
        $item = Testimonials::find($id);
        return view('admin.testimonials.edit',compact('item'));
    }

    
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
           'name' => 'required|min:3',
           'designation' => 'required',
           'image'  => 'image|mimes:jpeg,png,jpg|max:2056',
        ]); 
        $data[] = '';
        $data   = Testimonials::productImage($request, $id);
        $request['alias'] = substr(str_replace(' ','',strtolower($request->name)), 0, 10);
        //dd($data);
        return view ('admin/jcrop/imagecrop', $data);        
        /*$re = Testimonials::find($id)->update($request->all());

        return redirect()->route('admin.testimonials.index')
                        ->with('success','Record updated successfully');*/
    }

    
    public function destroy($id)
    {
        Testimonials::find($id)->delete();
        return redirect()->route('admin.testimonials.index')
                        ->with('success','Record deleted successfully');
    }
}
