@extends('admin/layouts/layout')

@section('title')
	| Subscription List
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
@endsection

@section('pageScripts')

	<script>
		
		function assignRm(subscriptionid, userid){
			$.ajax({
				url: "{{url('/admin/rm/assignRmAjax')}}",
				type: 'POST',
				dataType: 'json',
				data: {subscriptionid:subscriptionid, userid:userid},
				beforeSend: function(){},
				success: function(result){
					console.log(result);
				},
			});
		}

		function changeSubscriptionStatus(subscriptionid, status){
			$.ajax({
				url: "{{url('admin/changeSubscriptionStatusAjax')}}",
				type: 'POST',
				dataType: 'json',
				data: {subscriptionid:subscriptionid, status:status},
				beforeSend: function(){},
				success: function(result){
					console.log(result);
				}
			});
		}
	</script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/easy-pie/jquery.easypiechart.min.js')}}"></script>

	<script type="text/javascript">
		$("#chart-easy, #chart-easy1, #chart-easy2").easyPieChart({
		    animate: 2000,
		    size: 40,
		    lineWidth: 2,
		    barColor: '#f44236',
		    trackColor: '#ddd',
		    scaleColor: false,
		});		
	</script>
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
			<h3 class="ml-15">List of all Subscriptions</h3>
		</div>
		<hr/>
		{!! Form::open(array('method' => 'get', 'action' => ['Admin\Subscription\SubscriptionController@showList'])) !!}
			
			<input type="text" name="email" placeholder="Subscriber Email">	
			<button type="submit">Search</button>
		{!! Form::close() !!}
		<div class="row table-mobile">
		@if(Session::has('message'))
				{{Session::get('message')}}	
			@endif
			<table class="table table-striped">
					<thead>
						<tr>
							<th>S no.</th>
							<th>Client ID</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Status</th>
							<th>Product</th>
							<th>Duration</th>
							<th>Time Left</th>
							<th>Assign Rm</th>
							<th>Current Status</th>
						</tr>
					</thead>
					<tbody>
					@foreach($subscriptions as $key => $subscription)
						<tr class="va-1">
							<td>{{$key+1}}</td>
							<td>TT123</td>
							<td>{{$subscription->phone}}</td>
							<td>{{$subscription->email}}</td>
							<td>Active</td>
							<td>{{$subscription->productinfo}}</td>
							<td>{{$subscription->equal_days}} days</td>
							<td>
								<center>
									<span>
										<div class="chart-easy chart-easy-custom" id="chart-easy" data-percent="{{$perc[$subscription->id]}}">
											<span class="percent2"></span>
										</div>
										{{$remaining_days[$subscription->id]}} days left
									</span>
								</center>
							</td>
							<td>
								<select class="form-control" onchange="assignRm({{$subscription->id}}, this.value)">
									<option>Select RM</option>
									@foreach($rms as $rm) 
										<option value="{{$rm->id}}" @if($current_rm[$subscription->id] == $rm->id) selected @endif>{{$rm->name}}</option>
									@endforeach
								</select>
							</td>

							<td>
								<select name="subscription_status" onchange="changeSubscriptionStatus({{$subscription->id}}, this.value)">
									<option value="open" @if($subscription->active_status == 'open') selected @endif>Open</option>
									<option value="closed" @if($subscription->active_status == 'closed') selected @endif>Close</option>
								</select>
							</td>
						</tr>
					@endforeach

					@if(count($subscriptions) == 0)
						<tr>
							<td colspan="9">No Recoard found</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection