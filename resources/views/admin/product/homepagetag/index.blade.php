@extends('admin/layouts/layout')

@section('title')
| Homepage Product Setting
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
			<li class="breadcrumb-item active">Homepage Product Setting</li>
		</ol>
		

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Homepage Product Setting</h3>
				<ul class="demo-header-actions">	
				<li class="demo-tabs">&nbsp;</li>			    
					<!-- <li class="demo-tabs"><a href="{{ route('admin.product.homepagetag.create') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li> -->
					
				</ul>
			</div>	
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
			@endif

		<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Tag Name</th>
					<th width="280px">Action</th>
				</tr>
				@foreach ($items as $key => $item)
				<tr>
					 <td>{{ ++$i }}</td>
					<td>{{ $item->tag }}</td>

					<td>
						<a class="btn btn-info" href="{{ route('admin.product.homepagetag.show',$item->id) }}">Show Products</a>
						<a class="btn btn-primary" href="{{ route('admin.product.homepagetag.edit',$item->id) }}">Edit</a>
						<!-- {!! Form::open(['method' => 'DELETE','route' => ['admin.product.homepagetag.destroy', $item->id],'style'=>'display:inline']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!} -->
					</td>
				</tr>
				@endforeach
		</table>
			{!! $items->render() !!}
			
		</div>
	</div>
</div>
@endsection
