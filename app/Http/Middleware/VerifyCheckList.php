<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session, DB;
use App\User;
use App\Models\Checklist\CheckList;

class VerifyCheckList{

    public function handle($request, Closure $next, $guard = null){
        
        $checklist = CheckList::first();
        
        if($checklist){
            if($checklist->personal_details_checked == 'yes' && $checklist->business_details_checked == 'yes' && $checklist->bank_details_checked == 'yes' && $checklist->upload_logo_checked == 'yes' && $checklist->upload_product_checked == 'yes' && $checklist->setted_marketplace_product == 'yes' && $checklist->manage_homepage_checked == 'yes' && $checklist->manage_navigation_checked == 'yes'){
                $checklist->checked_everything = 'yes';
                $checklist->save();
            }
        }
        return $next($request);
    }
}
