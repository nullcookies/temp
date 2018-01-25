@extends('admin/layouts/layout')

@section('title')
	| {{'Product Upload'}}
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">

@endsection

@section('pageScripts')
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<h4>Products</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Products</a></li>
			<li class="breadcrumb-item"><a href="#">Add Products</a></li>
			<li class="breadcrumb-item active">Upload From Other Website</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Upload Using Flipkart, Amazon & Paytm Link</h3>
			</div>
		</div>
	</div>
	<div class="container row-upload">
		<div class="col-md-12">
		{!! Form::open(array('method' => 'post', 'action' => ['Admin\Product\ProductController@getparse'])) !!}
			<div class="col-md-12">
				<h4 class="paste-link">Paste Link</h4>
			</div>
			<div class="col-md-6 paste-link-box">
				<input type="text" class="col-md-10" name="link" placeholder="Paste Your Link Here.."/>	
			</div>
			<div class="col-md-6 loading-box">
				<div class="col-md-6">
					<input type="submit" name="submit" value="parse">
				</div>
			</div>
		{!! Form::close() !!}
		</div>
		<!-- <div class="row upload-add-button">
			<a href="#">Add &nbsp;<i class="fa fa-plus"></i></a>
		</div>
		<div class="container save-button4">
			<button type="submit" class="btn btn-success">Submit</button>
			</div> -->
	</div>
@endsection