@extends('admin/layouts/layout')

@section('title')
| Homepage Social Media
@endsection

@section('pageTopScripts')
<style>
	legend {font-size: 1.2rem;width: 21.6%;}
	fieldset{border:1px solid #ccc;}
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
	<div class="container-fluid">		
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item active">Homepage Social Media</li>
		</ol>
		
		@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session::get('success') !!}.</strong>				
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
				<h3 class="head-position">Homepage Social Media</h3>
				<ul class="demo-header-actions">				    
					<li class="demo-tabs"><a href="{{ url('admin/socialmedia/addsocial') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
					
				</ul>
			</div>	
			

		<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Alias</th>
					<th>Link</th>
					<th width="280px">Action</th>
				</tr>
				@foreach ($items as $key => $item)
				<tr>
					 <td>{{ ++$i }}</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->slug }}</td>
					<td>{{ $item->link }}</td>
					
					<td>
						<a class="btn btn-primary" href="{{ url('admin/socialmedia/editsocial/'.$item->id) }}">Edit</a>
						{!! Form::open(['method' => 'DELETE','action' => ['Admin\WebsiteSetting\WebsiteSettingController@deletesocial'],'style'=>'display:inline']) !!}
						{{ Form::hidden('id', $item->id) }}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
		</table>
			{!! $items->render() !!}
			
		</div>
	</div>
</div>
@endsection
