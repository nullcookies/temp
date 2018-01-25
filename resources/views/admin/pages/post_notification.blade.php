@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">
@endsection

@section('pageScripts')
		
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
	<script>
		$(document).ready(function(){
			$("#summernote").summernote({
				disableResizeEditor: true,
				minHeight : 200,
			});

			$('#summernote_textarea').attr('name','product_desc');

			$('#save_product_form').submit(function(){
				$('textarea[name="product_desc"]').val($('#summernote_content').html());
			});
		});

	</script>
	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>

@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<h3 class="ml-15">Post Notifications</h3>

		@if(Session::has('message'))
			<div class="alert alert-{{Session::has('class') ? Session::get('class') : ''}}">
			  <strong>{{Session::get('message')}}</strong>
			</div>
		@endif
		<div class="box-block bg-white">
			{!! Form::open(array('method' => 'post', 'id' => 'save_product_form', 'action' => ['Admin\Pages\PagesController@showNotificationAdminPage'])) !!}
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Type</label>
					<div class="col-sm-10">
						<select name="type">
							<option value="notification">Notification</option>
							<option value="notice">Notice</option>
						</select>
						@if($errors->has('type')) <span class="text-danger">{{$errors->first('type')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="title" placeholder="Title">
						@if($errors->has('title')) <span class="text-danger">{{$errors->first('title')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Comment</label>
					<div class="col-sm-10 summernote-row">
						<div id="summernote" >
							{!!Old('product_desc')!!}
						</div>
						@if($errors->has('product_desc')) <span class="text-danger">{{$errors->first('product_desc')}}</span> @endif
					</div>
				</div>
				<center>
					<button type="submit" class="btn btn-success">Post</button>
				</center>
			{!! Form::close() !!}			
		</div>
	</div>
@endsection