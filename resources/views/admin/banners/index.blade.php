@extends('admin/layouts/layout')

@section('title')
| Catalogue Management
@endsection

@section('pageTopScripts')
<style>
	.hide{display:none;}
	.subcategory{margin:0 0 10px 0;}
	.padding-bottom30{padding-bottom: 30px;}
	select,input{margin-bottom:10px;}
</style>

<style>

	.wrap {
		background-color: #FFD6D2;
		border-top: solid 1px #FDB6AE;
		border-bottom: solid 1px #FDB6AE;

	}

	thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
	}
	table {
	    width:100%;
	}
	
	thead, tbody tr {
	    display:table;
	    width:100%;
	    table-layout:fixed;/* even columns width , fix width of table too*/
	}

	tbody tr{
		background-color: #D4FCDF;
		border-bottom: solid 1px #98FDB4;
		border-top: solid 1px #98FDB4;
	}

	tbody {
	    display:block;
	    max-height:250px;
	    overflow:auto;
	}
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

<div class="content-area py-1">
	<div class="container-fluid">
		<h4>Upload Homepage Banner</h4>
		<div class="box-block bg-white">
			@if(Session::has('danger'))
				<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('danger') !!}.</strong>
				</div>
				@endif

				@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('success') !!}.</strong>
				</div>
				@endif
			{!! Form::open(['files' => true, 'method' => 'post', 'action' => ['Admin\Banner\BannerController@saveBanner']]) !!}
			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Link</label>
				<div class="col-sm-12">
					<input type="text" class="form-control" value="{{Old('link')}}" id="subject" name="link" placeholder="Album Name">
					@if($errors->has('link')) <span class="text-danger">{{ $errors->first('link') }} </span>@endif
				</div>
			</div>
			
			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Upload File</label>
				<div class="col-sm-12">
					<input type="file" name="file">
					@if($errors->has('file')) <span class="text-danger">{{ $errors->first('file') }} </span>@endif
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-purple">Create Album</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>


<div class="content-area py-1">
	<div class="container-fluid">
		<h4>Album List</h4>
		@if($errors->has('invalid_parameters')) 
			<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! $errors->first('invalid_parameters') !!}.</strong>
			</div>
		@endif

		@if(Session::has('delete_error')) 
			<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session('delete_error') !!}.</strong>
			</div>
		@endif

		@if(Session::has('delete_success')) 
			<div class="alert alert-success alert-dismissible fade in mb-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session('delete_success') !!}.</strong>
			</div>
		@endif
		<div class="box-block bg-white">
		@if(Session::has('delete-success'))
		<div class="alert alert-success">
		  {!! Session::get('delete-success') !!}
		</div>
		@endif

		<div class="box-block bg-white">
		@if(Session::has('delete-danger'))
		<div class="alert alert-danger">
		  {!! Session::get('delete-danger') !!}
		</div>
		@endif
			<form action="{{url('/admin/banners/delete')}}" method="POST">
			{{csrf_field()}}
			<table class="table" style="height: 10px;">
				<thead>
					<tr>
						<th>#</th>
						<th>image</th>
						<th>link</th>
					</tr>
				</thead>
				<tbody>
					@foreach($banners as $banner)
						<tr>
							<td><input type="checkbox" value="{{$banner->id}}" name="bannerid[]"></td>
							<td><img width="100" class="img-responsive" src="{!! url('images/banners/'.$banner->image) !!}"></td>
							<td><a href="{{$banner->link}}">{!! $banner->link !!}</a></td>
						</tr>
					@endforeach
				</tbody>
				
				<tfoot>
				
				<tr>
					<td colspan="2"><button type="submit" class="btn btn-danger">Delete Selected</button></td>
				</tr>
				
				</tfoot>
			</table>
			</form>
		</div>
	</div>
</div>
@endsection
