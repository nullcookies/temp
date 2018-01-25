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
	<h4>Notifications & Notices</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Notices</li>
	</ol>
	<div class="box box-block bg-white">
		<div class="clearfix">
			<div class="float-md-left">
				<div class="form-group">
					{!! Form::open(array('method' => 'get','action' => ['Admin\StaticPage\StaticPagesController@notices'])) !!}
					<input type="text" autocomplete="off" class="form-control" name="q" placeholder="Search...">
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="management mb-1">
		@foreach($results as $result)
			<div class="m-item pad-1-5">
				<div class="mi-title">
					<a class="text-black">{{$result->title}}</a>
					<div class="float-md-right">
						<span class="font-90 text-muted">{{$result->type}}</span>
					</div>
				</div>
				<div class="mi-text">{!! $result->content !!}</div>
				<div class="clearfix">
					<div class="float-md-right">
						<span class="font-90 text-muted">{{date_format(date_create($result->created_at),'D d-m-Y H:i')}}</span>
					</div>
				</div>
			</div>
		@endforeach
		</div>
		<nav class="text-xs-right">
			@if(count($results)) <span>{!! $results->render() !!}</span> @endif
		</nav>
	</div>
</div>
@endsection