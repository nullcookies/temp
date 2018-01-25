@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
@endsection

@section('pageScripts')
	<script>
		$(document).ready(function(){
			var stateSelector   =   $('#state');
			var themeSelector	=	$('#theme');
			var planSelector 	=	$('#plan');
			var timeslotSelector=	$('#time_slot');

			stateSelector.on('change', function(){
				getStateWiseCity(stateSelector.val());
			});
			getStateWiseCity(stateSelector.val());

			$('#theme, #plan, #time_slot').on('change', function(){
				getPrice(themeSelector.val(), planSelector.val(), timeslotSelector.val());
			});

			getPrice(themeSelector.val(), planSelector.val(), timeslotSelector.val());
		});

		function getStateWiseCity(stateid){
			$.ajax({
				url: "{{url('/admin/getCityAjax')}}",
				type: 'GET',
				data:{stateid: stateid},
				dataType: "json",
				beforeSend: function(){
					$('#city').html('<option>Loading..</option>');
				},
				success: function(result){
					$('#city').html('');
					var count = result['count'];
					for(i=0; i<count; i++){
						$('#city').append('<option value="'+result['cities'][i].id+'">'+result['cities'][i].name+'</option>');
					}
				},
			});
		}

		function getPrice(themeid, planid, timeslotid){
			$.ajax({
				url: "{{url('/admin/getPriceAjax')}}",
				type: 'GET',
				data: {themeid:themeid, planid:planid, timeslotid:timeslotid},
				dataType: 'json',
				beforeSend: function(){},
				success: function(result){
					$('#total_amt').val(result['price']);
					$('#total_amt_tag').html('<i class="fa fa-inr"></i>'+result['price']);
				},
			});
		}
	</script>
	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/easy-pie/jquery.easypiechart.min.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<div class="box box-block bg-white">
		<div class="row">
			<h3 class="ml-15">Create Subscribers</h3>
		</div>
		<hr/>
		<div class="row">
			<div class="box-block">
				{!! Form::open(array('class' => 'form-material material-primary', 'method' => 'post', 'action' => ['Admin\Subscription\SubscriptionController@saveSubscription'])) !!}

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Select Theme</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" id="theme" name="theme">
							@foreach($themes as $theme)
								<option value="{{$theme->id}}">{{$theme->product_name}}</option>
							@endforeach
							</select>
							@if($errors->has('theme'))<span class="text-danger">{{$errors->first('theme')}}</span>@endif
						</div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Select Plan</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" id="plan" name="plan">
							@foreach($plans as $plan)
								<option value="{{$plan->id}}">{{$plan->plan}}</option>
							@endforeach
							</select>
							@if($errors->has('plan'))<span class="text-danger">{{$errors->first('plan')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Select Duration</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" name="time_slot" id="time_slot">
							@foreach($timeslots as $timeslot)
								<option value="{{$timeslot->id}}">{{$timeslot->slotname}}</option>
							@endforeach
							</select>
							@if($errors->has('time_slot'))<span class="text-danger">{{$errors->first('time_slot')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Payable Amt</label>
						<div class="col-sm-10">
							<input type="hidden" name="total_amt" id="total_amt">
							<strong id="total_amt_tag"><i class="fa fa-inr"></i>1399</strong>
							@if($errors->has('total_amt'))<span class="text-danger">{{$errors->first('total_amt')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" id="name" placeholder="Name">
							@if($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Email-ID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" id="name" placeholder="Email Address">
							@if($errors->has('email'))<span class="text-danger">{{$errors->first('email')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Contact Number</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="phone" id="name" placeholder="Contact Number">
							@if($errors->has('phone'))<span class="text-danger">{{$errors->first('phone')}}</span>@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Country</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" id="country" name="country" name="country">
								@foreach($countries as $country)
									<option value="{{$country->id}}">{{$country->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">State</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" id="state" name="state">
								@foreach($states as $state)
									<option value="{{$state->id}}">{{$state->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">City</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" id="city" name="city">
							@foreach($cities as $city)
								<option value="{{$city->id}}">{{$city->name}}</option>
							@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Street Address</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="street_address" placeholder="Enter Street Address"></textarea>
							@if($errors->has('street_address'))<span class="text-danger">{{$errors->first('street_address')}}</span>@endif
						</div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Zipcode</label>
						<div class="col-sm-10">
							<input type="text" name="zipcode" class="form-control" placeholder="Enter zipcode">
							@if($errors->has('zipcode'))<span class="text-danger">{{$errors->first('zipcode')}}</span>@endif
						</div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Payment Mode</label>
						<div class="col-sm-10">
							<select class="subscribers-pay" name="payment_mode">
								<option>Cash</option>
								<option>Cheque</option>
								<option>Demand Draft</option>
							</select>
							@if($errors->has('payment_mode'))<span class="text-danger">{{$errors->first('payment_mode')}}</span>@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Name of Creator</label>
						<div class="col-sm-10">
							<h3 class="creator-name">{{Auth::user()->name}}</h3>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">Create</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection