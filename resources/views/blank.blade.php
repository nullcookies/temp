@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item active">{!! $title !!}</li>
		</ol>
		@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong>{!! Session::get('success') !!}. New ID : {!! Session::get('category_id') !!}</strong>
		</div>				
		@endif

		@if(Session::has('danger'))
		<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong>{!! Session::get('danger') !!}.</strong>
		</div>
		@endif
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="#" class="btn btn-success">Add New</a></li>					
				</ul>
			</div>
		</div>
		<!-- Content -->

		<!-- Content -->
		</div>
	@endsection
