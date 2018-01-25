@extends('admin/layouts/layout')

@section('title')
| Homepage Page
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
			<li class="breadcrumb-item active">Testimonial</li>
		</ol>
		

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Testimonial</h3>
				<ul class="demo-header-actions">				    
					<li class="demo-tabs"><a href="{{ route('admin.testimonials.create') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
					
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
					<th>Avatar</th>
                    <th>Name</th>
                    <th>Designation</th>                    
                    <th>Content</th>
                    
                    
                    <th width="280px">Action</th>
				</tr>
				@if(count($items) > 0)
				@foreach ($items as $key => $item)
				<tr>
					<td>{{ ++$i }}</td>
					<td><img src="{{url('testimonials/'.$item->image)}}" class="dropify"></td>
					<td>{{ $item->name }}</td>                    
                    <td>{{ $item->designation }} </td>
                    <?php 
                    $desc = urldecode($item->content);
                    ?>
                    <td>{!! substr(strip_tags($desc),0,100) !!} </td>
                    

					<td>
						<a class="btn btn-primary" href="{{ route('admin.testimonials.edit',$item->id) }}">Edit</a>
						{!! Form::open(['method' => 'DELETE','action' => ['Admin\WebsiteSetting\TestimonialsController@destroy', $item->id],'style'=>'display:inline']) !!}
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
