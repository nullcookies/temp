@extends('admin/layouts/layout')

@section('title')
	| {{$title}}
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
@endsection

@section('pageScripts')
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>	
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
	<h4>Create User</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="{!! url(ADMIN_URL_PATH) !!}">Home</a></li>
		<li class="breadcrumb-item"><a href="{!! url(ADMIN_URL_PATH.'/user_management') !!}">User Management</a></li>
		<li class="breadcrumb-item active">Create User</li>
	</ol>
	<div class="box box-block bg-white">
		{!! Form::open(array('method' => 'post', 'action' => ['Admin\User\UserManagementController@save_user'])) !!}
			<div class="form-group">
				<label><strong>Full Name</strong></label> 
				<input type="text" class="form-control" name="user_name" value="{{Old('user_name')}}" placeholder="Enter Full Name">
				@if($errors->has('user_name'))<span class="text-danger">{{$errors->first('user_name')}}</span>@endif
			</div>
			<div class="form-group">
				<label><strong>Email</strong></label>
				<input type="email" class="form-control" name="user_email" value="{{Old('user_email')}}" placeholder="Enter Valid Email">
				@if($errors->has('user_email'))<span class="text-danger">{{$errors->first('user_email')}}</span>@endif
			</div>
			<div class="form-group">
				<label><strong>Mobile Number</strong></label>
				<input type="text" class="form-control" name="mobile_number" value="{{Old('mobile_number')}}" placeholder="Enter Mobile Number">
				@if($errors->has('mobile_number'))<span class="text-danger">{{$errors->first('mobile_number')}}</span>@endif
			</div>
			<div class="form-group">
				<label><strong>Password</strong></label>
				<input type="text" class="form-control" name="password" placeholder="Enter Password">
				@if($errors->has('password'))<span class="text-danger">{{$errors->first('password')}}</span>@endif
			</div>
			<div class="form-group">
				<label><strong>Confirm Password</strong></label>
				<input type="text" class="form-control" name="confirm_password" placeholder="Retype Password">
				@if($errors->has('confirm_password'))<span class="text-danger">{{$errors->first('confirm_password')}}</span>@endif
			</div>
			<div class="form-group">
				<label><strong>Gender</strong></label>
				<p>
					<label class="form-check-inline">
						<input class="form-check-input" type="radio" @if(Old('gender') == 'male') checked @endif name="gender" value="male"> Male
					</label>
					<label class="form-check-inline">
						<input class="form-check-input" type="radio" @if(Old('gender') == 'female') checked @endif name="gender" value="female"> Female
					</label>
				</p>
				<p>
					@if($errors->has('gender'))<span class="text-danger">{{$errors->first('gender')}}</span>@endif
				</p>
			</div>
			<div class="form-group">
				<label><strong>User Type</strong></label>
				<p>
					<label class="form-check-inline">
						<input class="form-check-input" type="radio" @if(Old('user_type') == 'customer') checked @endif name="user_type" value="customer"> Customer
					</label>
					<label class="form-check-inline">
						<input class="form-check-input" type="radio" @if(Old('user_type') == 'admin') checked @endif name="user_type" value="admin"> Admin
					</label>
				</p>
				<p>
					@if($errors->has('user_type'))<span class="text-danger">{{$errors->first('user_type')}}</span>@endif
				</p>
			</div>
			<div class="form-group">
				<label><strong>Access Mode</strong>&nbsp;<span><a data-container="body" data-toggle="popover" data-placement="right" title="What is access mode ?" data-content="Access mode set the permissions for users, if they have only read permission or have read-write permission." href="javascript:;"><i class="fa fa-question-circle-o"></i></a></span></td></label>
				<p>
					@foreach($access_modes as $access_mode)
						<label class="form-check-inline">
							<input class="form-check-input" type="radio" name="access_mode" @if(Old('access_mode') == $access_mode->id) checked @endif value="{{$access_mode->id}}"> {{$access_mode->authority}}
						</label>
					@endforeach
				</p>
				<p>
					@if($errors->has('access_mode'))<span class="text-danger">{{$errors->first('access_mode')}}</span>@endif
				</p>
			</div>
			<div class="form-group">
				<input type="submit" name="create_user" class="btn btn-success" value="Create User">
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection