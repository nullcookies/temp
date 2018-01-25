@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')}}">
<style>
		.run-toast{cursor: pointer;}
	</style>	
@endsection

@section('pageScripts')
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')}}"></script>	
<script>
function saveme(id) {
	var min = $('#tr_'+id+' [name=standmin]').val();
	var max = $('#tr_'+id+' [name=standmax]').val();
	var comm = $('#tr_'+id+' [name=standcommission]').val();
	$.ajax({
		url: "{{url('/admin/commission/saveStandCommission')}}",
		type: 'post',
		dataType: 'html',
		data: {id:id,min:min,max:max,comm:comm},
		beforeSend: function(){
		},
		success: function(json){
			jsonobj = JSON.parse(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.success(jsonobj.msg);			
		},
	});
}


function deleteme (id) {
	$.ajax({
		url: "{{url('/admin/commission/deleteStandCommission')}}",
		type: 'post',
		dataType: 'html',
		data: {id:id},
		beforeSend: function(){
		},
		success: function(json){
			jsonobj = JSON.parse(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.error(jsonobj.msg);
			$('#tr_'+id).hide();			
		},
	});
}

$(document).ready(function(){
	/*$('#btnUpdateCatCommission').on('click',function(event){
		$('#frm_cat_commission').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "{{url('/admin/commission/saveCatCommission')}}",
				type : 'POST',
				data: $('#frm_cat_commission').serialize(),
				dataType: 'json',
				success: function(result){
					console.log(result);
				}
			});
		});
		$('#frm_cat_commission').submit();
	});*/
});
	$('[name=category]').change(function(){

		var id = $(this).val();
		$.ajax({
		url: "{{url('/admin/commission/setdefaultcategory')}}",
		type: 'post',
		dataType: 'json',
		data: {id:id},
		beforeSend: function(){
		},
		success: function(json){
			//jsonobj = JSON(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.success(json['msg']);			
		},
	});
	});
		
		
	
	
</script>


@if($errors->has('minprice') || $errors->has('maxprice') || $errors->has('commission'))
	<script type="text/javascript"> 
	    $(document).ready(function(){
	        $("#standard").modal('show',{backdrop: 'static', keyboard: false});
	    });
	</script>
@endif
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Commission Type - 2</li>
	</ol>
	<div class="card card-block"><p id="result"></p>
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $message }}</strong>
		</div>				
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $message }}</strong>
		</div>				
		@endif
		<div class="row">
			<div class="col-md-6">
				<h5 class="head-position">Standard Commission</h5>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="#" class="btn btn-primary w-min-sm mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#standard" data-whatever="@mdo">Add</a></li>					
				</ul>
				<table class="table mb-md-0">
					<thead>
						<tr>
							
							<th>Min Selling Price</th>
							<th>Max Selling Price</th>
							<th>Commision in %</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach($standard_commission as $commission)
						<tr id="tr_{{$commission->id}}">
							
							<td><div class="col-md-12"><input type="text" value="{{$commission->min}}" name="standmin" class="form-control"></div></td>
							<td><div class="col-md-12"><input type="text" value="{{$commission->max}}" name="standmax" class="form-control"></div></td>
							<td><div class="col-md-12"><input type="text" value="{{$commission->commission}}" name="standcommission" class="form-control"></div></td>
							<td><a href="javascript:void(0);" onclick="saveme({{$commission->id}})" class="btn btn-sm btn-success">Update</a></td>
							<td><a href="javascript:void(0);" onclick="deleteme({{$commission->id}})" class="btn btn-sm btn-danger">Delete</a></td>
							<!--  -->
						</tr>
						@endforeach	
					</tbody>
				</table>
				<div class="modal fade" id="standard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="exampleModalLabel">Add New Standard Commission</h4>
							</div>
							{!! Form::open(['id' => 'frm_standard_commission', 'method'=>'post', 'action' => ['Admin\Commission\CommissionController@postStandard']])  !!}

							<div class="modal-body">											
								<div class="form-group row">
									<label for="minprice" class="col-xs-3 col-form-label">Min Price:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="minprice" id="minprice">
										@if($errors->has('minprice')) <span class="text-danger">{{ $errors->first('minprice') }} </span> @endif
									</div>
								</div>
								<div class="form-group row">
									<label for="maxprice" class="col-xs-3 col-form-label">Max Price:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="maxprice" id="maxprice">
										@if($errors->has('maxprice')) <span class="text-danger">{{ $errors->first('maxprice') }} </span> @endif
									</div>
								</div>
								<div class="form-group row">
									<label for="commission" class="col-xs-3 col-form-label">Commision in %:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="commission" id="commission">
										@if($errors->has('commission')) <span class="text-danger">{{ $errors->first('commission') }} </span> @endif
									</div>
								</div>											
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-check-inline">
						<input type="radio" value="2" name="category" id="chk_standard" @if($default_category == 2) checked @endif class="form-check-input"><h4>Standard Commission</h4> 
					</label>
				<label class="form-check-inline">
					<input type="radio" value="1" name="category" id="chk_category" @if($default_category == 1) checked @endif class="form-check-input"> <h4>Category Commission</h4>
				</label>

			</div>
		</div>	

	</div>
	<div class="card card-block">
	<div class="row">
		<div class="col-md-12">
			<h5 class="mb-1">Category Commission</h5>
			{!! Form::open(['id' => 'frm_cat_commission', 'method' => 'post', 'action' => ['Admin\Commission\CommissionController@saveCatCommission']])  !!}
			<ul class="demo-header-actions">
				<li class="demo-tabs"><button type="submit" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Update Category Commision</button></li>
			</ul>	
						
			<table class="table mb-md-0">
				<thead>
					<tr>
						<th>SN</th>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Commision in %</th>

					</tr>
				</thead>
				<tbody>

					<?php $i = $category_commission->perPage() * ($category_commission->currentPage()-1) ?>
					
					@foreach($category_commission as $category)
					<tr id="tr_{{$category->id}}">
						<th scope="row">{{++$i}}</th>
						<td><div class="col-xs-4"><input type="text" value="{{$category->category_id}}" name="catid[]" class="form-control" readonly="true"></div></td>
						<td>{{$category->category}}</td>
						<td><div class="col-xs-4"><input type="text" value="{{$category->price}}" name="catcommission[]" class="form-control"></div></td>

					@endforeach
				</tbody>
			</table>
			{!! Form::close() !!}
			<div class="paging-footer">
				<div class="col-md-3">
					<div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{ $category_commission->total()}} orders</div>
				</div>
				<div class="col-md-9">
					@include('admin.pagination.limit_links', ['paginator' => $category_commission])
				</div>
			</div>
		</div>

	</div>		
</div>
</div>				
@endsection  