<?php  

namespace App\Http\Controllers\Admin\StaticPage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages\NotificationModel;

class StaticPagesController extends Controller{
    
    public $data;
    public function __construct(){
        $this->data     =   array();
    }

    public function notices(Request $request){
        $this->data['results']                  =   NotificationModel::orderBy('created_at','desc');

        if($request->has('q')){
            $searchVar                          =   $request->q;
            $this->data['results']              =    $this->data['results']->where(function($query) use ($searchVar){
                $query->where('title','like','%'.$searchVar.'%');
                $query->orWhere('content','like','%'.$searchVar.'%');
            });
        }

        $this->data['results']  =   $this->data['results']->paginate(10);
    	return view('admin/static/notice', $this->data);
    }

    public function serviceAgreements(){
    	return view('admin/static/service_agreements');
    }

    public function review(){
    	return view('admin/static/review');
    }
}
