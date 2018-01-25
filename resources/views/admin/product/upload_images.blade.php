@extends('admin/layouts/layout')

@section('title')
	| {{'Coupons'}}
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">

	<style>
		#suggested_categories li{
			cursor: pointer;
		}

		.pending-images img{
			margin: .3%;
			opacity: .3;
		}
	</style>

@endsection

@section('pageScripts')
	<script>
		$(document).ready(function(){
			$('#upload-images').on('change', function(event){
				$('#upload-images').attr('disabled','disabled');
				$.each(event.target.files, function(index,value){
					if(value['size'] < 1000000 && $.inArray(value['type',['image/jpeg','image/png']])){
						$('<img id="pending_'+index+'" width="100" height="100" />').attr('src',URL.createObjectURL(value)).appendTo('.pending-images');
					}else{
						$('<img id="pending_'+index+'" width="100" height="100" />').attr('src',URL.createObjectURL(value)).appendTo('.rejected-images');
					}
				});

				$.each(event.target.files, function(index,value){
					if(value['size'] < 1000000 && $.inArray(value['type',['image/jpeg','image/png']]) ) {
						var formData = new FormData();
						formData.append('image', value); 
						$.ajax({
							url : "/admin/product/uploadImages",
							type: 'post',
							data: formData,
							dataType: 'json',
							contentType: false,
	    					processData: false,
							beforeSend: function(){
								$('#pending_'+index).css('opacity','1');
							},
							success:  function(result){
								if(result['success']){
									$('#pending_'+index).css('display','none');
									$('<tr class="completed_tr_'+index+'"></tr>').appendTo('.completed-images-table');
									$('<td class="completed_td_image_'+index+'"></td>').appendTo('.completed_tr_'+index);
									$('<td class="completed_td_link_'+index+'"></td>').appendTo('.completed_tr_'+index);
									$('<img id="completed_image_'+index+'" width="100" height="100" />').attr('src',URL.createObjectURL(value)).appendTo('.completed_td_image_'+index);
									$('<span><span/>').text(result['image_url']).appendTo('.completed_td_link_'+index);
								}
							}
						});
					}
				});
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


@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<h4>Upload Images</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{url('admin/product')}}">Products</a></li>
			<li class="breadcrumb-item"><a href="{{url('admin/product/upload')}}">Add Products</a></li>
			<li class="breadcrumb-item active">Upload Images</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Upload Images (Do not refresh the page, else you will loose your uploaded data)</h3>
			</div>
		</div>
	</div>
	<div class="container row-upload">
		<div class="col-md-12">
			@if(Session::has('incorrect_mime'))
				<div class="alert alert-danger">
				  <strong>{!! Session::get('incorrect_mime') !!}</strong> 
				</div>
			@endif
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="upload-images">Upload Images</label>
				<input type="file" accept="image/x-png, image/png, image/gif, image/jpeg" name="image[]" multiple id="upload-images">
			</div>
		</div>

		<div class="col-md-12 pending-images">
			<h5>Pending Images <span class="count"></span></h5>
		</div>

		<div class="col-md-12 rejected-images">
			<h5>Rejected Images <span class="count"></span></h5>
		</div>

		<div class="col-md-12 completed-images">
			<h5>Completed Images <span class="count"></span></h5>
			<table class="table completed-images-table">
			</table>
		</div>
		
	</div>
@endsection