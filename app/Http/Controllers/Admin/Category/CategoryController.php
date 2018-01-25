<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use DB,Auth,Session,Response,Redirect;
use App\Category;
use App\Http\Controllers\Front\Products\ProductController as FrontProduct;
use App\Models\Api\ApiCategory;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public $data;
	public function __construct()
    {
        $this->data             =   array();
        $this->middleware('auth');
    }
    public function index()
    {   
        $category_obj = new Category;        
    	$data    				= array();
        $catVar                 =   array();
        $data['title']          = 'Categories';
        //$frontProductObj        =   new FrontProduct;        
        $data['maincategory']          =   $categories  =   DB::table('category')->where('parentId',0)->get();
        
        foreach($categories as $key => $category){
            $catVar[$key]['id']       =   $category->id;
            $catVar[$key]['category'] =   $category->category;
            $catVar[$key]['flag']     =   $category->flag;
            $catVar[$key]['child']    =   $category_obj->getAllChild($category->id);
        }
        $data['categories']  = $catVar; 
        return view('admin/category/index',$data);
    }
    public function create(){        
        $data                   = array();
        $data['title']          =   'Add Category';
        $parentId               = 0; 
        $data['category']       = DB::table('category')->where('parentId', $parentId)->get();
        return view('admin/category/add',$data);
    }

    public function save(CategoryRequest $request)
    {     
        
        foreach ($request->all() as $key => $value) {
            $$key               =   $value;
        }   
        $variants = 1;
        $alias = !empty($request->category) ? preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->category)) :'';              
        if(isset($request->top1)){
            $cid = $request->top1;
        }
        if (isset($request->top2) && $request->top2>0) {
            $cid = $request->top2;
        } 
        if(isset($request->top3) && $request->top3>0){
            $cid = $request->top3;
        }
        if (isset($request->top4) && $request->top4>0) {
            $cid = $request->top4;
        } 
        if(isset($request->top5) && $request->top5>0){
            $cid = $request->top5;
        }     
       $chk = DB::table('category')
                            ->where('parentId', $cid)
                            ->where('category', $request->category)
                            ->count();
        //dd($cid);
        if($chk > 0){
            Session::flash('danger','Category already exist. Try another category name.');            
            return redirect(ADMIN_URL_PATH.'/category/add');            
        }
        $storeCategory = DB::table('category')->insertGetId(array(
            'category'              =>  $request->category,
            'parentId'              =>  $cid,
            'status'                =>  $request->status,
            'varient'               =>  $variants,
            'recordInsertedBy'      =>  Auth::user()->id,
            'sort_order'            =>  $request->sort_order,
            'name_alias'            =>  $alias,
        ));

        if(!$storeCategory){
            Session::flash('danger','Data Cant saved');
            return Redirect::back();
        }
        Session::flash('success','Category Successfully Saved');
        Session::flash('category_id',$storeCategory);
        return redirect(ADMIN_URL_PATH.'/category/add');
    }
    public function subCategory(Request $request)
    {
        $error          =   false;
        //pr($request->all(), "MM");
        if(!$request->ajax()){
            $error      = true;
        }      
        
        if(!$request->has('subcategory')){
            $error      = true;
        } 

        if(!$request->has('categoryId')){
            $error      =   true;
        }        
    
        if($error){
            echo 'invalid request';
            exit;
        }
        if($request->subcategory){
            $parentcategoryid   = $request->categoryId;            
            $this->data         = DB::table('category')
                                ->where('parentId', $parentcategoryid)
                                ->get();

            return Response::json(array('success' => 'true', 'data' => $this->data));     
        }      
        
    }
    public function ajaxCall(Request $request)
    {
        $error      = false;
        if(!$request->ajax()){
             $error      = true;
        }
        if($error){
            echo 'invalid request';
            exit;
        }
        $flagupdate = (int)$request->flagupdate;        
        if($flagupdate){             
            $flagValue          = $request->flag;
            $this->data         = DB::table('category')
                                    -> where('id',$request->id)
                                    ->update(['flag' => $flagValue]);

            $msg                =  $flagValue == 'yes' ? 'selected' : 'unselected';
            return Response::json(array('success' => 'true', 'msg' => 'Category successfully '.$msg));
        }
        if($request->allcategory){       
            $parentCategoryId          = $request->categoryId;              
            $this->data         = DB::table('category')
                                ->where('parentId', $parentCategoryId)
                                ->get();

            return Response::json(array('success' => 'true', 'data' => $this->data));     
        }

    }
    public function categorylist(Request $request)
    {
        $data                   = array();
        $data['title']          =   'Category List';
        $parentId               = 0; 
        $categories             = DB::table('category AS c')->join('category AS ca', 'ca.id', '=', 'c.parentId','left');
        $data['serchVal']       =   isset($request->cat) ? $request->cat : '';
        if(isset($request->cat) && sizeof($request->cat) >0){
            $search             =   $request->cat;
            $categories         =   $categories->where('c.category','like',$search.'%');
        }

        $data['categories']     = $categories->orderBy('c.parentId')
                                ->select('c.*','ca.category AS parentcategory')
                                ->paginate(10);                               
        return view(ADMIN_URL_PATH.'/category/categorylist',$data);
    }
    
    public function edit($id)
    {
        $data                   = array();
        $data['title']          = 'Category Edit';
        $data['category']       = DB::table('category AS c')
                                ->join('category AS ca', 'ca.id', '=', 'c.parentId','left')
                                ->orderBy('c.parentId')
                                ->select('c.*','ca.category AS parentcategory')
                                ->where('c.id',$id)
                                ->first();
        return view(ADMIN_URL_PATH.'/category/edit',$data);
    }
    public function update(CategoryRequest $request, $id)
    {        
        $status = ($request->status>0) ? 'enable' : 'disable';
        $alias = !empty($request->category) ? preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->category)) :'';
        $category = DB::table('category')->where('id',$id)->update([
            'category'      => $request->category,
            'status'        => $status,
            'sort_order'    => $request->sort_order,
            'name_alias'    => $alias,
            ]);
        
        if(!$category){
            Session::flash('danger','Data Can\'t saved or no update');
            return Redirect::back();
        }

        Session::flash('success','Category Successfully Update');         
        return redirect(ADMIN_URL_PATH.'/category/categorylist');       
    }
    public function updateparentcategory(Request $request, $id)
    {        
        if(isset($request->top1)){
            $cid = $request->top1;
        }
        if (isset($request->top2) && $request->top2>0) {
            $cid = $request->top2;
        } 
        if(isset($request->top3) && $request->top3>0){
            $cid = $request->top3;
        }
        if (isset($request->top4) && $request->top4>0) {
            $cid = $request->top4;
        } 
        if(isset($request->top5) && $request->top5>0){
            $cid = $request->top5;
        }              
        $category = DB::table('category')->where('id',$id)->update([
            'parentId'      => $cid            
            ]);
        if(!$category){
            Session::flash('danger','Whoops, looks like something went wrong.');
            return Redirect::back();
        }
        Session::flash('success','Category Updated');         
        return redirect(ADMIN_URL_PATH.'/category/categorylist');       
    }
    public function deletecategory(Request $request)
    {  
        $categoryid = $request->categoryid;
        $deleteQuery = Category::find($categoryid)->delete();        
        if($deleteQuery)
        {            
            Session::flash('class', "danger");
            Session::flash('deleted', "Category Deleted Successfully.");
            return Redirect::back();
        }
        else
        {
            Session::flash('class', "danger");
            Session::flash('someerror', "Due to some error the item is not removed from system.. Try again !!");
            return Redirect::back();
        }        
    }
    public function getCategorysynch(Request $request)
    {
        $data                   = array();
        $data['title']          = 'Category Synchronization'; 
        $data['categories']     = Category::all();
        $data['catwithapicategory']  =  array();
        $categoryModel = new Category;        
        if(Schema::hasColumn($categoryModel->getTable(), 'api_alias_id')){
            $data['catwithapicategory']     = Category::where('api_alias_id','>',0)->paginate(15);
        }
        
        return view('admin/category/categorysynch',$data);
    }

    public function ajaxSynchCategory(Request $request){
        $apicategories  = Category::apiCategoriesAll();                  
        return Response::json(['success' => true, 'apicategories' => $apicategories]);
    }

    public function postSynchCategory(Request $request){
        $categoryModel = new Category;
        $tab           = true;
        if(!Schema::hasColumn($categoryModel->getTable(), 'api_alias_id'))  // check column exist in category table
        {
            $tab        =   false;
        }

        if(!$tab){
            $tab = Schema::table($categoryModel->getTable(), function($table) {  // add new column in category table
                $table->integer('api_alias_id');
            });
        }

        if($tab){
            $id  = $request->categories;
            $apiid = $request->apicategories;
            $result = DB::table($categoryModel->getTable())->where('id',$id)->update(['api_alias_id' => $apiid]);
            if(!$result){
                Session::flash('danger','Data Can\'t saved or no update');
                return Redirect::back();
            }
            Session::flash('success','Api Cateogry ID set to Categpry');         
            return redirect(ADMIN_URL_PATH.'/categorysynch');            
        }
    }
    
}
