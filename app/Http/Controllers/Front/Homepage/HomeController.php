<?php

namespace App\Http\Controllers\Front\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use View;
use Counter;
use App\Models\Banners\Banners;
use App\Models\Product\HomepageTag;
use App\Models\Product\HomepageTagProduct;
use App\Models\Product\HomepageHotDeal;
use App\Http\Controllers\HelperFunctionController;
use Carbon\Carbon, DB;
use App\Models\Socialmedia;
use App\Models\Pages\Testimonials;
use App\Models\Pages\Pages;
use BrowserDetect;
use App\Models\Cart\Cart;
use App\Http\Controllers\Admin\WebsiteSetting\HomepageNavController, Auth;
/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        Counter::showAndCount('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data                   = array();
        $data['project_name']   = PROJECT_NAME;
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
        if(BrowserDetect::detect()->isMobile){
            $homepagenav        = new HomepageNavController;
            $allCategories  =   $homepagenav->fetchAllHomePageNav();
            $data['navCategories']  =   $homepagenav->getChildFromArray(0, $allCategories);
            $data['cartCount']       =  Auth::user() ? Cart::where('user_id', Auth::user()->id)->select(DB::raw('count(*) as count'))->first()->count : 0;
            return View::make('front.homepage.mobileHomepage', $data);exit;
        }
        return View::make('front.homepage.homepage', $data);
    }
    public function commonpage()
    {
        $data[]              = '';
        $data['socialmedia'] = Socialmedia::get();
        $data['homesetting'] = DB::table('homesetting')->first();
        $data['pages']       = Pages::where('status','yes')->get();
        return $data;
    }
    public function pages($alias)
    {
        $data[]              = '';
        $data['pages']       = Pages::where('status','yes')->where('alias',$alias)->first();
        $data['pagesTT']       = Pages::where('status','yes')->select(['id','alias','name'])->get();
        return view('front.homepage.pages',$data);
    }
}
