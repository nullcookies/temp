@extends('admin/layouts/layout')

@section('title')
	| create-rm
@endsection

@section('pageTopScripts')
	<style>
		i{
			font-size: 24px !important;
		}

		table a .fa-arrow-circle-o-up{
			color: #20b9ae !important;
		}

		table a .fa-arrow-circle-o-down{
			color: #f59345 !important;
		}
	</style>
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')}}">
	
@endsection

@section('pageScripts')
	<script>
		function doAuthority(userid){
			if($('#checkbox'+userid).is(':checked')){
				assignRmAuthority(userid);
			}else{
				removeRmAuthority(userid);
			}
		}

		function assignRmAuthority(userid){
			$.ajax({
				url: "{{url('/admin/rm/makeRmAjax')}}",
				type: 'POST',
				data: {userid:userid},
				dataType: 'json',
				beforeSend: function(){},
				success:  function(result){
				},
			});
		}

		function removeRmAuthority(userid){
			$.ajax({
				url: "{{url('/admin/rm/removeRmAjax')}}",
				type: 'POST',
				data: {userid:userid},
				dataType: 'json',
				beforeSend: function(){},
				success:  function(result){
				},
			});
		}
	</script>
	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')}}"></script>

@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row">
				<h3 class="ml-15">Search</h3>
			</div>
			<hr/>
			<div class="row">
				<div class="box-block">
					{!! Form::open(array('method' => 'get', 'action' => ['Admin\RelationshipManager\RelationshipManagerController@create'])) !!}
						<div class="form-group row">
							<label for="store-name" class="col-sm-2 col-form-label">Search By Name or email</label>
							<div class="col-sm-8">
								<input type="text" autocomplete="off" required="" class="form-control" name="q" id="search_for_rm" placeholder="Enter search key">
							</div>
							<div class="col-sm-2">
								<button class="form-control btn btn-success" >Search</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		@if($show)
			<div class="box box-block bg-white">
				@if(count($users)>0)
				<div class="row">
					<div class="box-block">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>S no.</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile Number</th>
									<th>is RM ?</th>
								</tr>
							</thead>
							<tbody>
							@foreach($users as $key => $user)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
									<td>{{$user->mobile}}</td>
									<td><input type="checkbox" onchange="doAuthority({{$user->id}})" id="checkbox{{$user->id}}" name="radio" @if($isRm) checked @endif ></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@else
					<strong>No Record matched to your search</strong>
				@endif
			</div>
		@endif
	</div>
@endsection