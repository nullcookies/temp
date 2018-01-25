<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banners\Banners;
use App\Models\Product\HomepageTag;
use App\Models\Product\HomepageTagProduct;
use App\Models\Product\HomepageHotDeal;
use App\Http\Controllers\HelperFunctionController;
use Carbon\Carbon, DB;
use App\Models\Socialmedia;
use App\Models\Pages\Testimonials;
use App\Models\Pages\Pages;
use App\Models\Checklist\CheckList;

class HomepageSettingController extends Controller
{
    public function index()
	{
		$data['title']  			= 'Manage Homepage';
		$data['logo']           = Banners::where('cid', 1)->where('status', 1)->first();        
        $data['right1']         = Banners::where('cid', 3)->where('status', 1)->first();        
        $data['right2']         = Banners::where('cid', 4)->where('status', 1)->first();        
        $data['right3']         = Banners::where('cid', 5)->where('status', 1)->first();        
        $data['contentstrip']   = Banners::where('cid', 6)->where('status', 1)->first();        
        $data['mainslider']     = Banners::where('cid', 2)->where('status', 1)->get();   
        $homepage_tag = HomepageTag::where('status', 'yes')->get();

        foreach ($homepage_tag as $key => $value) { 
            $data['tagproduct'][] = [
                'id'        => $value->id,
                'tagname'   => $value->tag,
                'products'  => HomepageTagProduct::where('tagid', $value->id)->get(),
            ];            
        }
        $data['topproduct'][] = $data['tagproduct'][0];
        unset($data['tagproduct'][0]);
        //dd($data['tagproduct']);
        /* Hot deal*/ 
        $take = 1;        
        $results    = HomepageHotDeal::where('start_date','<=',Carbon::now()->format('Y-m-d'))
        ->where('end_date','>',Carbon::now()->format('Y-m-d'))
        ->orderBy('sortorder','ASC')->take($take)
        ->get(); 
        $data['hotdeals'] = array();
        foreach($results as $result){
            if(($result->old_price-$result->new_price) >0){ 
                $totalsave = (($result->old_price-$result->new_price)/$result->old_price)*100;
            }else{ 
                $totalsave = 0;
            }

            $data['hotdeals'][] = [
                'id'        => $result->id,
                'image'         => $result->image,
                'name'      => $result->name,
                'rating'    => $result->rating,
                'link'  => $result->link,
                'old_price'     => $result->old_price,
                'new_price'     => $result->new_price,
                'totalsave'     => round($totalsave),               
                'sortorder'     => $result->sortorder,
                'start_date'    => $result->start_date,
                'end_date'      => $result->end_date,
                'endtime'       => Carbon::parse($result->end_date)->formatLocalized('%m/%d/%Y') .' '.date("H:i:s",strtotime($result->end_date)),
            ];
        }              
        $data['socialmedia'] = Socialmedia::get();
        $data['homesetting'] = DB::table('homesetting')->first();
        $data['pages']       = Pages::where('status','yes')->get(); 
        $data['testimonials']= Testimonials::where('status','yes')->get();
        
        $checklist = CheckList::first() ? CheckList::first() : new CheckList;
        $checklist->manage_homepage_checked = 'yes';
        $checklist->save();
		return view('admin/website/homepage/index', $data);
	}
    public function homesetting(Request $request)
    {
        $result = 0;
        //dd($request->all());
        if(isset($request->data)){
            $result = DB::table('homesetting')->update([$request->key => $request->data]);
        }
        if($result){            
            return redirect()->to('admin/homepage/#alt_phone')->with('success', 'Updated !!');
        }else{
            return redirect()->to('admin/homepage')->with('danger', 'Not Updated !!');
        }
    }
}
