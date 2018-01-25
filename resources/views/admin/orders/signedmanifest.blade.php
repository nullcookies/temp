@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
	.dropify-wrapper{height: 300px !important;}
	.signBtn{text-align: center; float: right; margin-top: 30px; margin-right: 0px;}
	.dropify-message span.file-icon:before{
	    content:url("{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/img/copy.png')}}") !important;
	}
	.dropify-wrapper .dropify-message p{
	    font-weight:bold !important;
	}
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/css/dropify.min.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/js/dropify.min.js')}}"></script>
<!--<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/js/newdropify.js')}}"></script>-->
<script type="text/javascript">
	$().ready(function(){
		$('.dropify').dropify();
		
		$('.dropify-message p').html('Upload Signed Manifest<br/>Click Here');
	});
	function getData(page) {
		var filter = $('input[name="filter"]:checked').val();
		var url = '<?php echo url("/admin/orders/return"); ?>';
		var str = '?page='+page+'&s='+filter;
		window.location.href = url+str;		
	}
	function changeStatus (id,status,oid) {
		$.ajax({
			url: "{{url('admin/orders/updateStatus')}}",
			type: 'POST',
			dataType: 'html',
			data: {id: id,status:status,oid:oid},
			beforeSend: function(){
				NProgress.start();
			},
			success: function(result){				
				if (result != '') {
					$("#action" + id).parents("tr").hide();
					$("#totalCount").html(parseInt($("#totalCount").html()) - 1);
					swal("Success !", "Status changed successfully", "success");
				}
				NProgress.done();
			},
		});
	}
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')

<div class="content-area py-1">
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Orders</li>
		</ol>

		<div class="box box-block bg-white">
			<div class="row">
				<h3>{!! $title !!}</h3>
			</div>
		</div>		
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif		
		<div class="box box-block bg-white">
			<div class="row">
				<!--<div class="col-md-2">
					<h5>Scan Copy</h5>                    
				</div>--->
				
				
				{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\Orders\OrdersController@postsignedmanifest']])}}
				
				<div class="col-md-6"> 
					<input type="hidden" name="oid" value="{{$orders->id }}">    
					<input type="hidden" name="oldscr" value="{{$orders->signedManifest }}">    					               
					<input type="file" id="signedManifest" name="signedManifest" class="dropify" data-max-file-size="2M" data-default-file="{{url('/product_images/'.$orders->signedManifest)}}"/>
					<div class="row signBtn">
						<button type="submit" name="save" class="btn btn-success">Save</button>
					</div>
					 
				</div>
				{{Form::close()}}
				<div class="col-md-6">
				    <h4>Kindly upload the copy of the manifest signed by the pickup boy who picked up your packet.</h4>
				    <br/>
				    <h4>This is to ensure that the product has been picked up from your end.</h4>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
