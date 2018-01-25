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
						<h4>Services &amp; Agreements</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Services &amp; Agreements</li>
						</ol>
						<div class="box box-block bg-white">
							<ul class="nav nav-tabs nav-tabs-2 mb-2">
								<li class="nav-item">
									<a class="nav-link active" href="#">All <span class="tag tag-primary ml-0-5">47</span></a>
								</li>
							</ul>
							<div class="clearfix">
								<div class="float-md-left">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Search...">
									</div>
								</div>
							</div>
							<div class="management mb-1">
								<div class="m-item pad-1-5">
									<div class="mi-title">
										<a class="text-black">1. Logistics Services Agreement</a>
									</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Read</a>
											<a class="btn btn-danger btn-sm" href="#"><i class="ti-trash mr-0-5"></i>Download</a>
										</div>
										<div class="float-md-right">
											<span class="font-90 text-muted">5 minutes ago</span>
										</div>
									</div>
								</div>
								<div class="m-item pad-1-5">
									<div class="mi-title">
										<a class="text-black">2. Commission Agreement</a>
									</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Read</a>
											<a class="btn btn-danger btn-sm" href="#"><i class="ti-trash mr-0-5"></i>Download</a>
										</div>
										<div class="float-md-right">
											<span class="font-90 text-muted">5 minutes ago</span>
										</div>
									</div>
								</div>
								<div class="m-item pad-1-5">
									<div class="mi-title">
										<a class="text-black">3. Marketplace Agreement</a>
									</div>
									<div class="clearfix">
										<div class="float-md-left">
											<a class="btn btn-success btn-sm" href="#"><i class="ti-check mr-0-5"></i>Read</a>
											<a class="btn btn-danger btn-sm" href="#"><i class="ti-trash mr-0-5"></i>Download</a>
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