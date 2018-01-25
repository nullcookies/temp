@extends('admin/layouts/layout')

@section('title')
	| {{'Setting'}}
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">

	<style>
		.radius12{
			border-radius: 12px !important;
		}
		.view-products-row table td:nth-child(7) {width: 1%;}
	</style>
@endsection

@section('pageScripts')

	<script>
		
		function changeStatus(requestid, status){
			$.ajax({
				url: "{{url('admin/domain_request/change_status_ajax')}}",
				type: 'post',
				data: {requestid: requestid, status: status},
				dataType: 'json',
				beforeSend: function(){},
				success: function(result){
					console.log(result);
				},	
			});
		}
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
	<h4>Seller Home</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<div class="box box-block bg-white">
		<div class="row">
			<h3 class="ml-15">All Domain Request</h3>
		</div>
		<hr/>
		
		<div class="row table-mobile">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>S no.</th>
						<th>Customer Name</th>
						<th>Customer Mobile</th>
						<th>Customer Email</th>
						<th>Domain Name</th>
						<th>Service Provider</th>
						<th>Username</th>
						<th>Password</th>
						<th>Status</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach($domainRequests as $key => $domainRequest)
						<tr class="va-1">
							<td>{{$key+1}}</td>
							<td>{{$domainRequest->customer_name}}</td>
							<td>{{$domainRequest->mobile}}</td>
							<td>{{$domainRequest->email}}</td>
							<td><a href="{{$domainRequest->domain_name}}" target="_blank">{{$domainRequest->domain_name}}</a></td>
							<td>{{$domainRequest->service_provider}}</td>
							<td>{{$domainRequest->user_name}}</td>
							<td>{{$domainRequest->password}}</td>
							<td>
								<select class="" onchange="changeStatus({{$domainRequest->id}},this.value)" id="status">
									<option value="pending" @if($domainRequest->status == 'pending') selected @endif>pending</option>
									<option value="completed" @if($domainRequest->status == 'completed') selected @endif >completed</option>
								</select>
							</td>
							<td>{{$domainRequest->created_at}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection