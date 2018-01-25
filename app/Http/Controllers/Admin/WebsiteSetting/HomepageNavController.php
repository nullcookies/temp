<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\HomepageNav\HomepageNavRequest;
use App\Http\Requests\Admin\HomepageNav\UpdateHomepageNavRequest;
use App\Http\Requests\Admin\HomepageNav\DeleteHomepageNavRequest;
use App\Models\HomepageNav\HomepageNav;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category, Redirect,Session;
use App\Models\Checklist\CheckList;

class HomepageNavController extends Controller{
    
    public $data;
    public function __construct(){
    	$this->data = array();
    }

    public function shownav(Request $request){
    	$this->data['title'] = 'Manage Homepage Navigation';
    	$allCategories 	=	self::fetchAllHomePageNav();
		$childs 		=	self::getChildFromArray(0, $allCategories);
		$this->data['categories'] = $childs;
		
		$checklist = CheckList::first() ? CheckList::first() : new CheckList;
        $checklist->manage_navigation_checked = 'yes';
        $checklist->save();
    	
    	return view('admin/website/homepage/nav',$this->data);
    }

    /* code start for getting all category array */

    public function fetchAllHomePageNav(){
    	$categories 	    =   HomepageNav::join('category','category.id','=','homepage_navs.catid')->select('homepage_navs.id','homepage_navs.category','homepage_navs.catid','homepage_navs.parentId','category.name_alias')->get();
		if(!$categories){
			echo 'category not exist';
			exit;
		}
		$carArr 		=	array();
		foreach($categories as $category){
			$carArr[]	=	array('id' => $category->id, 'name' => $category->category, 'category_id' => $category->catid, 'parentId' => $category->parentId, 'alias' => $category->name_alias);
		}

		return $carArr;
    }

    public function getChildFromArray($category_id = 0, $allCategories){

    	$childs 		=	array();
    	foreach($allCategories as $key => $category){
    		if($category['parentId'] != $category_id){
    			continue;
    		}

    		$childs[]				=	$category;
    		$childs[count($childs)-1]['childs'] 	=	self::getChildFromArray($category['id'], $allCategories);
    	}

    	return $childs;
    }

    /* code ends for getting all category array */

    public function getAddCategoryModelContent(Request $request){
    	if(!$request->ajax()){
    		exit;
    	}

    	if(!$request->has('parentId')){
    		exit;
    	}

    	$parentId = $request->parentId;
        $catParent = $request->catParent;
        $categories = Category::leftJoin('category as c1','c1.id','=','category.parentId')->leftJoin('category as c2','c2.id','=','c1.parentId')->leftJoin('category as c3','c3.id','=','c2.parentId')->orderBy('category.id')->select('category.id','category.category','category.parentId','c1.category as parentTop1','c2.category as parentTop2','c3.category as parentTop3')->orderBy('category','asc')->get();
    	return view('admin/website/homepage/popup/addCategory', array('parentId' => $parentId,'categories' => $categories));
    }

    public function saveNewCategory(HomepageNavRequest $request){
        foreach($request->all() as $key => $value){
            $$key = $value;
        }

        $homepageNav = new HomepageNav;
        $homepageNav->catid = $categoryId;
        $homepageNav->parentId = $parentId;
        $homepageNav->category = $category_name;

        if(!$homepageNav->save()){
            Session::flash('save_fail','fail');
            return Redirect::back();
        }
        
        Session::flash('save_success','Category Saved Successfully');
        return Redirect::back();
    }

    public function getEditCategoryModelContent(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('catid')){
            exit;
        }

        if(!$request->has('navid')){
            exit;
        }

        if(!$request->has('catName')){
            exit;
        }

        $navid = $request->navid;
        $catid = $request->catid;
        $currentName = $request->catName ;
        $categories = Category::leftJoin('category as c1','c1.id','=','category.parentId')->leftJoin('category as c2','c2.id','=','c1.parentId')->leftJoin('category as c3','c3.id','=','c2.parentId')->orderBy('category.id')->select('category.id','category.category','category.parentId','c1.category as parentTop1','c2.category as parentTop2','c3.category as parentTop3')->orderBy('category','asc')->get();

        return view('admin/website/homepage/popup/editCategory', array('categories' => $categories, 'navid' => $navid,'catid' =>$catid, 'catname' => $currentName  ));

    }

    public function editCategory(UpdateHomepageNavRequest $request){
        foreach($request->all() as $key => $value){
            $$key = $value;
        }

        $homepageNav = HomepageNav::find($navid);

        if(!$homepageNav){
            Session::flash('save_fail','fail');
            return Redirect::back(); 
        }

        $homepageNav->catid = $categoryId;
        $homepageNav->category = $category_name;

        if(!$homepageNav->save()){
            Session::flash('save_fail','fail');
            return Redirect::back();
        }
        
        Session::flash('save_success','Category Updated Successfully');
        return Redirect::back();
    }

    public function getDeleteCategoryModelContent(Request $request){
        if(!$request->ajax()){
            exit;
        }

        if(!$request->has('navid')){
            exit;
        }

        if(!$request->has('catName')){
            exit;
        }

        $navid       = $request->navid;
        $currentName = $request->catName;
        return view('admin/website/homepage/popup/deleteCategory', array('navid' => $navid,'catname' => $currentName  ));
    }

    public function deleteCategory(DeleteHomepageNavRequest $request){
        foreach($request->all() as $key => $value){
            $$key = $value;
        }

        $homepageNav = HomepageNav::find($navid);

        if(!$homepageNav){
            Session::flash('delete_fail','fail');
            return Redirect::back(); 
        }

        if(!$homepageNav->delete()){
            Session::flash('delete_fail','fail');
            return Redirect::back();
        }
        

        Session::flash('save_success','Category Deleted Successfully');
        return Redirect::back();
    }
}
