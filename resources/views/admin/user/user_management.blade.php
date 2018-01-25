@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
@endsection

@section('pageScripts')
	<style type="text/css">
	@-moz-document url-prefix(){
	.btn-adjust{padding: 0.5rem 0.8rem;}
	}
	</style>
	@if($errors->has('repeat_password') || $errors->has('new_password'))
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#reset_pass{{old('user_id')}}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@if($errors->has('update_customer_name') || $errors->has('update_customer_mobile') || $errors->has('update_gender') || $errors->has('update_user_id') )
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#update_user_info{{old('update_user_id')}}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@if($errors->has('change_access_mode_user_id') || $errors->has('new_access_mode'))
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#change_access_mode{{old('change_access_mode_user_id')}}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@if($errors->has('new_user_type') || $errors->has('change_user_type_user_id'))
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#change_user_type{{old('change_user_type_user_id')}}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>	
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">

	<h4>User Management</h4>
	@if($canwrite)
	<span class="pull-right"><a href="{{url(ADMIN_URL_PATH.'/create_user')}}" class="btn btn-success">Create User</a></span>
	@endif
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="{!! url(ADMIN_URL_PATH) !!}">Home</a></li>
		<li class="breadcrumb-item active">User Management</li>
	</ol>
	<div class="box box-block bg-white">
	   {!! Form::open(array('method' => 'get', 'action' => ['Admin\User\UserManagementController@index'])) !!}
	   		<div class="row">
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Name, Email or Mobile</label>
						<input type="text" name="q" placeholder="Type for search.." value="{{$filterq}}" class="form-control">
						<span class="font-90 text-muted">EX: Tarun, tarun@gmail.com, 9717403522</span>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">User Type</label>
						<select name="user_type" class="form-control">
							<option value="all" @if($filter_user_type == 'all') selected  @endif >All</option>
							<option value="customer" @if($filter_user_type == 'customer') selected  @endif >Customer</option>
							<option value="admin" @if($filter_user_type == 'admin') selected  @endif >Admin</option>
						</select>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Access Mode</label>
						<select name="access_mode" class="form-control">
							<option value="all" @if($filter_access_mode == 'all') selected  @endif >All</option>
							@foreach($access_modes as $access_mode)
							<option value="{{$access_mode->id}}" @if($filter_access_mode == $access_mode->id) selected  @endif >{{$access_mode->authority}}</option>
							@endforeach
						</select>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
	   					<label class="">Action</label>
						<input type="submit" class="form-control btn btn-primary" value="Search" >
					</div>
	   			</div>
	   		</div>
	   {!! Form::close() !!}
	   @if($errors->has('user_id'))
	   <div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-danger-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<strong>Cant Delete User!</strong> <a class="btn btn-outline-white" href="{!! url(ADMIN_URL_PATH.'/user_management') !!}">Reload</a>  The page and try again
				</div>
	   		</div>
	    </div>
		@endif

		@if(Session::has('err_msg'))
		<div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-danger-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					{!! Session::get('err_msg') !!}
				</div>
	   		</div>
	    </div>
		@endif

		@if(Session::has('success_msg'))
		<div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-success-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					{!! Session::get('success_msg') !!}
				</div>
	   		</div>
	    </div>
		@endif
       <div class="table-responsive">
           <table class="table table-bordered table-striped">
              <thead>
                 <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>user_type</th>
                    <th>User Access Mode</th>
                    <th>Created_at</th>
                    <th>Modified At</th>
                    @if($canwrite)
                    <th>Action</th>
                 	@endif
                 </tr>
              </thead>
              <tbody>
              	@foreach($users as $key => $user)
                 <tr>
                 	<th>{{$key+1}}</th>
                    <th>{{$user->name}}</th>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->user_type}}@if($canwrite) <span data-placement="right" data-toggle="tooltip" title="Change User Type" class="pull-right"><a href="javascript:;" data-toggle="modal" data-target=".modal.change_user_type{{$user->id}}" data-backdrop="static" data-keyboard="false"><i class="fa fa-exchange"></i></a></span>@endif</td>
                    <td>{{$user->authority}}@if($canwrite) <span data-placement="right" data-toggle="tooltip" title="Change Access Mode" class="pull-right"><a href="javascript:;" data-toggle="modal" data-target=".modal.change_access_mode{{$user->id}}" data-backdrop="static" data-keyboard="false" ><i class="fa fa-exchange"></i></a></span>@endif</td>
                    <td>{{date('D d-m-Y',strtotime($user->created_at))}}</td>
                    <td>{{date('D d-m-Y',strtotime($user->updated_at))}}</td>
                    @if($canwrite)
                    <td>
                    <span data-placement="top" data-toggle="tooltip" title="Edit Basic Info"><button type="button" class="btn btn-primary btn-adjust" data-toggle="modal" data-target=".modal.edit_info{{$user->id}}" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil"></i></button></span>
                    <span data-placement="top" data-toggle="tooltip" title="Reset User Password"><button type="button" class="btn btn-warning btn-adjust" data-toggle="modal" data-target=".modal.reset_pass{{$user->id}}" data-backdrop="static" data-keyboard="false"><i class="fa fa-key"></i></button></span>
                    <span data-placement="top" data-toggle="tooltip" title="Delete User"><button type="button" class="btn btn-danger btn-adjust" data-toggle="modal" data-target=".modal.tada.delete{{$user->id}}" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></button></span>
					<div class="modal animated tada delete{{$user->id}} small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Confirmation Popup</h4>
								</div>
								<div class="modal-body">
									Are you really want to delete user ?
								</div>
								<div class="modal-footer">
									{!! Form::open(array('method' => 'delete','action' => ['Admin\User\UserManagementController@deleteUser'])) !!}
										<input type="hidden" name="user_id" value="{!! $user->id !!}">
										<button type="submit" class="btn btn-primary">Yes, Delete</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
					<!-- Reset Password Popup -->
					<div class="modal animated reset_pass{{$user->id}} small-modal" id="reset_pass{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						{!! Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@reset_password'])) !!}
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Enter New Password For <b>{{$user->name}}</b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group text-bold">
											<label> <strong>New Password</strong></label>
											<input type="password" name="new_password" placeholder="Enter New Password" class="form-control">
											@if($errors->has('new_password'))<span class="text-danger">{{$errors->first('new_password')}}</span>@endif
										</div>
										<div class="form-group">
											<label><strong>Repeat Password</strong></label>
											<input type="password" name="repeat_password" placeholder="Again Type Password" class="form-control">
											@if($errors->has('repeat_password'))<span class="text-danger">{{$errors->first('repeat_password')}}</span>@endif
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="user_id" value="{!! $user->id !!}">
									<button type="submit" class="btn btn-primary">Reset</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						{!! Form::close() !!}
						</div>
					</div>
					<!-- End Reset Password Popup -->

					<!-- Update User Basic Info Popup -->
					<div class="modal animated edit_info{{$user->id}} small-modal" id="update_user_info{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						{!! Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@edit_user_basic_info'])) !!}
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel"><b>{{$user->name}}</b> Profile</h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group text-bold">
											<label> <strong>User Name</strong></label>
											<input type="text" name="update_customer_name" value="{{Old('update_customer_name') ? Old('update_customer_name') : $user->name}}" placeholder="Enter Customer Name" class="form-control">
											@if($errors->has('update_customer_name'))<span class="text-danger">{{$errors->first('update_customer_name')}}</span>@endif
										</div>
										<div class="form-group">
											<label><strong>User Mobile</strong></label>
											<input type="text" name="update_customer_mobile" value="{{Old('update_customer_mobile') ? Old('update_customer_mobile') : $user->mobile}}" placeholder="Enter Customer Mobile" class="form-control">
											@if($errors->has('update_customer_mobile'))<span class="text-danger">{{$errors->first('update_customer_mobile')}}</span>@endif
										</div>
										<div class="form-group">
											<label><strong>Gender</strong></label>
											<p>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="update_gender" value="male" @if(Old('update_gender') == 'male' || $user->user_gender == 'male') checked @endif > Male
												</label>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio" name="update_gender" value="female"  @if(Old('update_gender') == 'female' || $user->user_gender == 'female') checked @endif > Female
												</label>
											</p>
											<p>
												@if($errors->has('update_gender'))<span class="text-danger">{{$errors->first('update_gender')}}</span>@endif
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="update_user_id" value="{!! $user->id !!}">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						{!! Form::close() !!}
						</div>
					</div>
					<!-- Update User Basic Info Popup -->

					<!-- Change Access mode Popup -->
					<div class="modal animated change_access_mode{{$user->id}} small-modal" id="change_access_mode{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						{!! Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@update_access_mode'])) !!}
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Change Access Mode For <b>{{$user->name}}</b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group">
											<label><strong>Access Mode</strong> &nbsp;<span><a data-container="body" data-toggle="popover" data-placement="right" title="What is access mode ?" data-content="Access mode set the permissions for users, if they have only read permission or have read-write permission." href="javascript:;"><i class="fa fa-question-circle-o"></i></a></span></label>
											<p>
												@foreach($access_modes as $access_mode)
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_access_mode" value="{!! $access_mode->id !!}" @if(Old('new_access_mode') == $access_mode->id || $user->authorityid == $access_mode->id ) checked @endif > {!! $access_mode->authority !!}
												</label>
												@endforeach
											</p>
											<p>
												@if($errors->has('new_access_mode'))<span class="text-danger">{{$errors->first('new_access_mode')}}</span>@endif
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="change_access_mode_user_id" value="{!! $user->id !!}">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						{!! Form::close() !!}
						</div>
					</div>
					<!--  Change Access mode Popup -->

					<!-- Change User Type Popup -->
					<div class="modal animated change_user_type{{$user->id}} small-modal" id="change_user_type{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						{!! Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@update_user_type'])) !!}
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Change User Type For <b>{{$user->name}}</b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group">
											<label><strong>User Type</strong> </label>
											<p>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_user_type" value="customer" @if(Old('new_user_type') == 'customer' || $user->user_type == 'customer' ) checked @endif > customer
												</label>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_user_type" value="admin" @if(Old('new_user_type') == 'admin' || $user->user_type == 'admin' ) checked @endif > Admin
												</label>
											</p>
											<p>
												@if($errors->has('new_user_type'))<span class="text-danger">{{$errors->first('new_user_type')}}</span>@endif
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="change_user_type_user_id" value="{!! $user->id !!}">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						{!! Form::close() !!}
						</div>
					</div>
					<!--   Change User Type Popup -->
                    </td>
                    @endif
                 </tr>   
                @endforeach   
              </tbody>
           </table>
           @if(count($users)>0)
           		<span class="pull-right"><?php echo $users->render(); ?></span>
           @endif
        </div>  
	</div>
</div>
@endsection