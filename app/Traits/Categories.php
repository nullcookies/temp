<?php

namespace App\Traits;
use App\Category;

trait Categories{
	
	public function getAllParents(){
		return Category::leftJoin('category as c1','c1.id','=','category.parentId')->leftJoin('category as c2','c2.id','=','c1.parentId')->leftJoin('category as c3','c3.id','=','c2.parentId')->orderBy('category.id')->select('category.id','category.category','category.parentId','c1.category as parentTop1','c2.category as parentTop2','c3.category as parentTop3')->orderBy('category','asc')->get();
	}
}

?>