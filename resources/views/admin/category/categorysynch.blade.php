@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')}}">
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
	$('[data-plugin="select2"]').select2($(this).attr('data-options'));
</script>
<script>

$(document).ready(function(){
	
});
function loadcategory(){
	$.ajax({
		url:'{{url("admin/categorysynch/apicategory")}}',
		type:'post',
		dataType: 'json',
		beforeSend: function(){
			$('.btn-success').html('Uploading....');
			$('#api_category_select').html('');
		},
		success: function(result){
			console.log(result);
			$('.btn-success').html('Synch Category');
			var count 		=	result['apicategories'].length;
			for(i=0; i<count ; i++){
				$('#api_category_select').append('<option value="'+result['apicategories'][i]['id']+'">'+result['apicategories'][i]['id']+' - '+result['apicategories'][i]['category']+'</option>');
			}
		},
		error: function(data, xhtResult){
			console.log(data);
			$('.btn-success').html(data['statusText']);
			$('.btn-success').css('color','red');
		}

	});
}
</script>
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
			<div class="row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="javascript:void(0);" onclick="loadcategory();" class="btn btn-success">Synch Category</a></li>					
				</ul>
			</div>
		</div>
		<!-- Content -->
		{{ Form::open(['id' => 'frmSynch', 'method' => 'post', 'action' => ['Admin\Category\CategoryController@postSynchCategory']])}}
		<div class="box box-block bg-white">
			<div class="form-group col-md-5">
				<label for="example-text-input" class="col-xs-4 col-form-label">Our categories</label>
				<div class="col-xs-8">
					<select class="search-product " name="categories" data-plugin="select2">
						<option>Select Category</option>
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->id }}: {{ $category->category }}</option>
						@endforeach
					</select>	
				</div>
			</div>
			<div class="form-group col-md-1"> + </div>
			<div class="form-group col-md-5">
				<label for="example-text-input" class="col-xs-4 col-form-label">API categories</label>
				<div class="col-xs-8"> 
					<select class="search-product" id="api_category_select" name="apicategories" data-plugin="select2">
						<option>Select Category</option>
						
					</select>	
				</div>
			</div>
			<div class="form-group col-md-1"> 
			<button class="btn btn-primary" type="submit">Synch</button>
			</div>
		</div>
		{{ Form::close()}}
		<div class="box box-block bg-white">
		<div class="col-md-6">
			<table class="table table-striped table-center">
				<thead>
					<tr>
						<th class="br-3">ID</th>							
						<th class="br-3">Category</th>
						<th class="br-1">Api Category ID</th>											
					</tr>
				</thead>
				<tbody>		
					@if($catwithapicategory)
					@foreach($catwithapicategory as $category)
					<tr>
						<td>{{ $category->id }}</td>																		
						<td>{{ $category->category }}</td>
						<td>{{ $category->api_alias_id }}</td>						
					</tr>
					@endforeach
					@else
					<tr><td colspan="12" align="center">No Data Found</td></tr>
					@endif

				</tbody>				
			</table>
		@if(count($catwithapicategory)>0)	@include('admin.pagination.limit_links', ['paginator' => $catwithapicategory]) @endif
			</div>

		</div>
		<!-- Content -->
		</div>
	@endsection
