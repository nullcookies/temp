@extends('admin/layouts/layout')

@section('title')
	| {{$title}}
@endsection

@section('pageTopScripts')
	<style>
		.run-toast{cursor: pointer;}
	</style>
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nestable/nestable.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')}}">	
@endsection

@section('pageScripts')

	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/ui-nestable.js')}}"></script>	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nestable/jquery.nestable.js')}}"></script>	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')}}"></script>	
<script type="text/javascript">
	
	$(document).ready(function(){
		toastr.options = {
			positionClass: 'toast-top-right'
		};
	});
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
	<div class="container-fluid">
		<h4>{!! $title !!}</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item active">{!! $title !!}</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="{{url('/admin/category/categorylist')}}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Category List</a></li>
					<li class="demo-tabs"><a href="{{url('/admin/category/add')}}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Create Category</a></li>
					
				</ul>
			</div>
			<div class="row">
				<div class="col-md-6 category-list" style="padding: 10px;">			        
			        @include('admin/category/category')			        
				</div>				
			</div>
		</div>
	</div>
</div>

@endsection
