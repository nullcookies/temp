<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product\HomepageTag;

class HomepageTagProductController extends Controller
{

    public function index(Request $request)
    {
        $items = HomepageTag::orderBy('id','DESC')->paginate(5);
        return view('admin.product.homepagetag.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
    public function show($id)
    {
        $item = HomepageTag::find($id);
        return view('admin.product.homepagetag.show',compact('item'));
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
    public function addProducts()
    {
       return view('admin.product.homepagetag.addProducts');
    }
}
