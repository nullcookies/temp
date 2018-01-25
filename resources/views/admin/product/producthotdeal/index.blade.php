@extends('admin/layouts/layout')

@section('title')
| Homepage Hot Deal
@endsection

@section('pageTopScripts')
<style>
	.dropify{height: 80px;width: 80px;}
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
			<li class="breadcrumb-item active">Homepage Hot Deal</li>
		</ol>
		

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Homepage Hot Deal</h3>
				<ul class="demo-header-actions">				    
					<li class="demo-tabs"><a href="{{ url('admin/product/producthotdealcreate') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
					
				</ul>
			</div>	
			@if(Session::has('success'))
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session::get('success') !!}.</strong>
			</div>				
			@endif
		<table class="table table-bordered">
				<tr>
					<th>SN</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Star Date</th>
                    <th>End Date</th>
                    <th>Rating</th>
                    <th width="280px">Action</th>
				</tr>
				@if(count($items) > 0)
				@foreach ($items as $key => $item)
				<tr>
					 <td>{{ ++$i }}</td>
					<td><a href="{{ $item->link }}">{{ $item->name }}</a></td>
                    <td><img src="{{url('products-images/'.$item->image)}}" class="dropify"></td>
                    <td>{{ $item->new_price }} Old: {{ $item->old_price }}</td>
                    <td>{{ date('D d M Y', strtotime($item->start_date)) }}</td>
                    <td>{{ date('D d M Y', strtotime($item->end_date)) }}</td>
                    <td>{{ $item->rating }}</td>

					<td>
						<a class="btn btn-primary" href="{{ url('admin/product/producthotdealedit',$item->id) }}">Edit</a>
						{!! Form::open(['method' => 'DELETE','action' => ['Admin\Product\HomepageTagController@producthotdealdestroy', $item->id],'style'=>'display:inline']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
						
					</td>
				</tr>
				@endforeach
				@else
				<tr><td colspan="9" align="center"> No any Data found in database</td></tr>
				@endif
				
		</table>
			{!! $items->render() !!}
			
		</div>
	</div>
</div>
@endsection
