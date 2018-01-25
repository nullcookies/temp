@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
@endsection

@section('pageScripts')
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/easy-pie/jquery.easypiechart.min.js')}}"></script>
	@foreach($subscriptions as $subsc)
		<script>
			$('#chart-easy-'+{{$subsc->id}}).easyPieChart({
			    animate: 2000,
			    size: 100,
			    lineWidth: 5,
			    barColor: '#ec1e32',
			    trackColor: '#ddd',
			});
		</script>
	@endforeach
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
		<h4>Subscription (Total {{$totalSubscription}})</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item active">Subscription</li>
		</ol>
		@foreach($subscriptions as $subscription)
		<div class="card">
			<div class="card-header clearfix">
				<h5 class="float-xs-left mb-0">Your Subscription</h5>								
			</div>
			<div class="card-block">
				<div class="row mb-2">
					<div class="col-sm-8 col-xs-12">
						<h5>Current Subscription</h5>
						<p><a class="text-primary" href="#"><span class="underline">{{$subscription->net_amount_debit}} Subscription</i></span></a></p>
						<table>
							<tbody>
								<tr>
									<td>Started On :</td>
									<td>{{$subscription->inserted_at}}</td>
								</tr>
								<tr>
									<td>Duration :</td>
									<td>{{$subscription->equal_days}} days</td>
								</tr>
								<tr>
									<td>Amount Paid :</td>
									<td>&nbsp;<i class="fa fa-inr"></i> {{$subscription->net_amount_debit}} + Taxes</td>
								</tr>
								<tr>
									<td>Plan Name :</td>
									<td>{{$subscription->productinfo}}</td>
								</tr>
								<!-- <tr>
									<td>Number of Users :</td>
									<td>1</td>
								</tr>
								<tr>
									<td>Number of Products :</td>
									<td>10000</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 mb-1">
					<div class="card price-card">
						<div class="card-header price-card-header bg-ec1e32 text-xs-center">
							<h6 class="text-uppercase">Business</h6>
							<h3 class="mb-0">
								<sup><i class="fa fa-inr"></i></sup>
								<span class="text-big">{{$subscription->net_amount_debit}}</span>
								<span class="text-small">/ mo</span>
							</h3>
						</div>
						<ul class="price-card-list pl-0 mb-0">
							<li>
								<i class="fa fa-check text-success mr-0-25"></i> Email preview on air
							</li>
							<li>
								<i class="fa fa-check text-success mr-0-25"></i> Spam testing and blocking
							</li>
							<li>
								<i class="fa fa-check text-success mr-0-25"></i> 100 GB Space
							</li>
							<li>
								<i class="fa fa-check text-success mr-0-25"></i> 200 user accounts
							</li>
							<li>
								<i class="fa fa-check text-success mr-0-25"></i> Free support for two years
							</li>
							<li>
								<i class="fa fa-remove text-muted mr-0-25"></i> Free upgrade for one year
							</li>
						</ul>
					</div>
			</div>
				<div class="col-sm-6 bg-white">
					<div class="box-block">
						<h4>Days Left In Your Subscription</h4>
						<p>{{$text[$subscription->id]}}, we recommend you to renew your subscription to avoid any kind of inconvenience and data loss.</p>
						<div class="col-md-4 col-xs-6">
							<div class="chart-easy" id="chart-easy-{{$subscription->id}}" data-percent="{{$perc[$subscription->id]}}"><span>{{$remaining_days[$subscription->id]}}</span></div>
						</div>
						<div class="col-md-8 col-xs-6">
							<center>
								<h3>{{$text[$subscription->id]}}</h3>
								<button class="btn renew-button">Renew Now</button>
							</center>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
		</div>
		@endforeach
	</div>
</div>
@endsection