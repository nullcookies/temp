@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
.deleteItem{position: absolute;margin-left: 10px;}
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
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item active">{!! $title !!}</li>
		</ol>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('success') !!}. </strong>
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

			</div>
		</div>

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
				    <li class="demo-tabs">
				    {!!Form::open(array('method' => 'get', 'class' => 'form-inline', 'action' => ['Admin\Category\CategoryController@categorylist']))!!}
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="text" class="form-control" name="cat" placeholder="Search for..." value="{{$serchVal}}">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					{!! Form::close() !!}
					</li>
					<li class="demo-tabs"><a href="{{url('/admin/category/add')}}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Create Category</a></li>
					
				</ul>
			</div>	
			<div class="row row-tabs">
				<table class="table table-striped table-varients">
					<thead>
						<tr>
							<th class="red-head">Category</th>
							<th class="red-head">Parent Category</th>
							
							<th><span style="color:red">&nbsp;Action</span></th>
						</tr>
					</thead>
					<tbody id="resultCategory">
						@foreach($categories as $category)
						<tr>
							<td @if($category->status == 'disable')style="color:red"@endif>
							{{$category->category}}</td>
							<td>{{$category->parentcategory}}</td>
							
							<td>
							<ul id="menu" style="margin:0px;padding-left:5px;">
							  <li><a href="{{ url('admin/category/edit/'.$category->id) }}" title="Edit" style="color:#000"><i class="fa fa-pencil"></i></a></li>
							  <li class="deleteItem">
							  	{!! Form::open(array('method' => 'delete', 'action' => ['Admin\Category\CategoryController@deletecategory'])) !!}
								<input type="hidden" name="categoryid" value="{{$category->id}}">
								<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_category_{{$category->id}}"><i class="fa fa-times"></i></a>
								<div class="modal animated rotateIn small-modal" id="delete_category_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="mySmallModalLabel">Category Delete Confirmation</h4>
											</div>
											<div class="modal-body">
												Are you sure to delete this record ?
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">yes</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
											</div>
										</div>
									</div>
								</div>
								{!! Form::close() !!}							  	
							  </li>
							</ul> 
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>		
				@if(count($categories) > 0)		 
				<div class="table-footer">
					<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{$categories->total()}} records</div></div>
					<div class="col-md-9">
					@include('admin.pagination.limit_links', ['paginator' => $categories])
					</div>
				</div>
				@endif
			</div>
			
		</div>
	</div>
</div>
@endsection
