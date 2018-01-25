<?php

namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect, Session, Mail, Validator, Response;
class BannerController extends Controller{

	public $data = [];
	public function __construct(){
	}

	public function index(){
		return view('admin/banners/index', $this->data);
	}
}
