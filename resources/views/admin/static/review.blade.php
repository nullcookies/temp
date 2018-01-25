@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
@endsection

@section('pageScripts')
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
						<h4>Reviews</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Reviews</li>
						</ol>
						<div class="box box-block bg-white">
							<ul class="nav nav-tabs nav-tabs-2 mb-2">
								<li class="nav-item">
									<a class="nav-link active" href="#">New <span class="tag tag-primary ml-0-5">47</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Approved</a>
								</li>
							</ul>
							<div class="clearfix">
								<div class="float-md-right mb-1">
									<select class="custom-select">
										<option selected>Action</option>
										<option value="1">Edit</option>
										<option value="3">Approve</option>
										<option value="2">Delete</option>
										<option value="3">Spam</option>
									</select>
								</div>
							</div>
							<div class="management mb-1">
								<div class="m-item">
									<div class="mi-checkbox">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input cci">
											<span class="custom-control-indicator"></span>
										</label>
									</div>
									<div class="mi-title">
										<a class="text-black">John Doe</a> commented on <a class="text-black">Lorem ipsum dolor</a>
									</div>
									<div class="mi-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam sem, imperdiet at mollis vestibulum, bibendum id purus. Aliquam molestie, leo sed molestie condimentum, massa enim lobortis massa, in vulputate diam lorem quis justo. Nullam nec dignissim mi. In non varius nibh. Proin et eros nisi, eu vulputate libero. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ultricies augue id risus dapibus blandit.</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Approve</a>
											<a class="btn btn-secondary btn-sm" href="#"><i class="ti-pencil mr-0-5"></i>Edit</a>
											<a class="btn btn-danger btn-sm mob-del-btn" href="#"><i class="ti-trash mr-0-5"></i>Delete</a>
										</div>
										<div class="float-md-right">
											<span class="font-90 text-muted">5 minutes ago</span>
										</div>
									</div>
								</div>
								<div class="m-item">
									<div class="mi-checkbox">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input cci">
											<span class="custom-control-indicator"></span>
										</label>
									</div>
									<div class="mi-title">
										<a class="text-black">John Doe</a> commented on <a class="text-black">Lorem ipsum dolor</a>
									</div>
									<div class="mi-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam sem, imperdiet at mollis vestibulum, bibendum id purus. Aliquam molestie, leo sed molestie condimentum, massa enim lobortis massa, in vulputate diam lorem quis justo. Nullam nec dignissim mi. In non varius nibh. Proin et eros nisi, eu vulputate libero. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ultricies augue id risus dapibus blandit.</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Approve</a>
											<a class="btn btn-secondary btn-sm" href="#"><i class="ti-pencil mr-0-5"></i>Edit</a>
											<a class="btn btn-danger btn-sm mob-del-btn" href="#"><i class="ti-trash mr-0-5"></i>Delete</a>
										</div>
										<div class="float-md-right">
											<span class="font-90 text-muted">5 minutes ago</span>
										</div>
									</div>
								</div>
								<div class="m-item">
									<div class="mi-checkbox">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input cci">
											<span class="custom-control-indicator"></span>
										</label>
									</div>
									<div class="mi-title">
										<a class="text-black">John Doe</a> commented on <a class="text-black">Lorem ipsum dolor</a>
									</div>
									<div class="mi-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam sem, imperdiet at mollis vestibulum, bibendum id purus. Aliquam molestie, leo sed molestie condimentum, massa enim lobortis massa, in vulputate diam lorem quis justo. Nullam nec dignissim mi. In non varius nibh. Proin et eros nisi, eu vulputate libero. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ultricies augue id risus dapibus blandit.</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Approve</a>
											<a class="btn btn-secondary btn-sm" href="#"><i class="ti-pencil mr-0-5"></i>Edit</a>
											<a class="btn btn-danger btn-sm mob-del-btn" href="#"><i class="ti-trash mr-0-5"></i>Delete</a>
										</div>
										<div class="float-md-right">
											<span class="font-90 text-muted">5 minutes ago</span>
										</div>
									</div>
								</div>
							</div>
							<nav class="text-xs-right">
								<ul class="pagination m-0">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">4</a></li>
									<li class="page-item"><a class="page-link" href="#">5</a></li>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
@endsection