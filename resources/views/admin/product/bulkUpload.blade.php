@extends('admin/layouts/layout')

@section('title')
	| {{'Product Bulk Upload'}}
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')}}">

	<style>
		#suggested_categories li{
			cursor: pointer;
		}
	</style>

@endsection

@section('pageScripts')
	
	<script>
		function showCategory(cat){
			console.log(cat);
			$.ajax({
				url: "{{url(ADMIN_URL_PATH.'/product/fetchCategory')}}",
				type: 'POST',
				data: {category:cat},
				dataType: 'html',
				beforeSend: function(){

				},
				success: function(result){
					$('#suggested_categories').html(result);
				}
			});
		}
	</script>

	<script>
		function addCategoryToProduct(catid){
			$.ajax({
				url: "{{url(ADMIN_URL_PATH.'/product/setupCategory')}}",
				type: 'POST',
				data: {catid:catid},
				dataType: 'html',
				beforeSend: function(){
				},
				success: function(result){
					$('#suggested_categories').html('');
					$('#searchText').val('');
					$('#final_categories').append(result);
				}
			});
		}
	</script>

	<script>
		function removeInput(id){
			$('#selected_catagoey_li_'+id).remove();
		}
		
		$(document).ready(function(){
			$("select").select2({
				placeholder: "Select Product Category",
  				allowClear: true
			});
		});
	</script>
	
	

	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<h4>Products</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Products</a></li>
			<li class="breadcrumb-item"><a href="#">Add Products</a></li>
			<li class="breadcrumb-item active">Upload Excel</li>
		</ol>
		<div class="box box-block bg-white">
		<div class="pull-right">
		@if($errors->has('product_csv')) <span class="alert alert-danger">{{$errors->first('product_csv')}} </span> @endif
		@if($errors->has('category')) <span class="alert alert-danger">{{$errors->first('category')}} </span> @endif
			@if(Session::has('incorrect_mime'))
				<div class="alert alert-danger">
				  <strong>{!! Session::get('incorrect_mime') !!}</strong> 
				</div>
			@endif
		</div>
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Upload Excel Sheet</h3>
			</div>
		</div>
	</div>
	<div class="container row-upload">		
		<div class="col-md-12">
			<div class="col-md-8 upload-list">
			<ul>
			<li><a target="_blank" href="{{url('admin/product/uploadImages')}}">Upload Images and get links</a></li>
				<li>Download Sample Sheet</li>
				<li>Fill Sheet</li>
				<li>Upload Products</li>
				<li>Preferred for products more than 10</li>
			</ul>
			</div>
			<div class="col-md-4 down-upload">
				<p class="downloadnow">*Don't have the Excel Sheet<a href="{{url('/sample_files/UploadingData.xlsx')}}" download><button type="button" class="btn btn-download w-min-sm mb-0-25 waves-effect waves-light"  data-toggle="modal" onclick="NProgress.start();">Download Now &nbsp;<i class="fa fa-download"></i></button></a></p>
			</div>
			<div class="row">
				<div class="col-md-8">
				<h3>Upload Excel Sheet as per the Prescribed Format</h3>
				</div>
			</div>
		</div>
		{!! Form::open(array('method' => 'post','files' => 'true','action' => ['Admin\Product\ProductController@upload_by_csv'])) !!}
			<div class="row form-row">
					<label for="uses-per-customer" class="col-sm-4 control-label"><span style="color:red">*</span>Select Categories:
										</label>
					<select name="category[]" multiple>
						@foreach($categories as $category)
							<option value="{{$category->id}}">@if(strlen($category->parentTop3)) {{$category->parentTop3}} / @endif @if(strlen($category->parentTop2)){{$category->parentTop2}}/ @endif  @if(strlen($category->parentTop1)){{$category->parentTop1}}/ @endif{{$category->category}}</option>
						@endforeach
					</select>
			</div>
			<div class="row form-row">
				<ul id="suggested_categories" class="suggested_categories">
				</ul>
			</div>
			<div class="row form-row">
				<ul id="final_categories">
				</ul>
			</div>
			<div class="row upload-excel">
				<div class="col-md-8">
					<h6>Upload Excel Sheet</h6>
				</div>
				<div class="col-md-4 text-center">
					<span class="btn btn-success btn-file" style="border-radius:0px;">
						Upload Now <i class="fa fa-upload"></i><input name="product_csv" type="file" accept=".xls, .xlsx">
					</span>
				</div>
			</div>
			<div class="row">
				<input type="submit" name="submit" value="Upload" class="btn btn-primary">
			</div>
		{!! Form::close() !!}
	</div>
@endsection