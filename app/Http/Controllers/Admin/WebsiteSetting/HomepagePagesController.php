<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages\Pages;
class HomepagePagesController extends Controller
{
    
    public function index(Request $request)
    {
        $items = Pages::orderBy('id')->paginate(10);
        return view('admin.pages.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    
    public function create()
    {
        return view('admin.pages.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            //'pagecontent' => 'required|min:10'
        ]);
        //dd($request->all());
        $request['alias'] = substr(str_replace(' ','',strtolower($request->name)), 0, 10);        
        Pages::create($request->all());
        return redirect()->route('admin.pages.index')
                        ->with('success','Record created successfully');
    }

   
    public function show($id)
    {
        $item = Pages::find($id);
        return view('admin.pages.edit',compact('item'));
    }

    
    public function edit($id)
    {
        $item = Pages::find($id);
        return view('admin.pages.edit',compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required|min:3',
        ]);
        $request['alias'] = substr(str_replace(' ','',strtolower($request->name)), 0, 10);  
        Pages::find($id)->update($request->all());
        return redirect()->route('admin.pages.index')
                        ->with('success','Record updated successfully');
    }

    
    public function destroy($id)
    {
        Pages::find($id)->delete();
        return redirect()->route('admin.pages.index')
                        ->with('success','Record deleted successfully');
    }
}
