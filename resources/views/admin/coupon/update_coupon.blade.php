@extends('admin/layouts/layout')

@section('title')
	| {{'Coupon-create'}}
@endsection

@section('pageTopScripts')	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	
@endsection

@section('pageScripts')
	<script>
	$('#langOpt').multiselect({
	    columns: 1
	});
	</script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Create Coupon</li>
		</ol>
		<div class="box box-block">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Update Coupon</h3>
			</div>
		</div>
			<div class="col-md-8">
			{!! Form::open(array('method' => 'post', 'action' => 'Admin\Coupon\CouponController@save_updated_data')) !!}
			<input type="hidden" name="coupon_id" value="{{$coupon_id}}">
				<div class="form-group row">
					<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Coupon Name:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" value="{{Old('coupon_name') ? Old('coupon_name') : $coupon->coupon_name}}" id="coupon-name" name="coupon_name" placeholder="">
						@if($errors->has('coupon_name')) <span class="text-danger">{{$errors->first('coupon_name')}}</span> @endif
					</div>
				</div>
				<div class="form-group  row">
					<label for="code" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Code:<br/><p style="font-size:10px">The code the customer enters to get the discount.</p></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="code" value="{{Old('coupon_code') ? Old('coupon_code') : $coupon->coupon_code}}" name="coupon_code" placeholder="">
						@if($errors->has('coupon_code')) <span class="text-danger">{{$errors->first('coupon_code')}}</span> @endif
					</div>
				</div>
				<div class="form-group  row">
					<label for="type"  class="col-sm-4 control-label">Type:<br/><p style="font-size:10px">Percentage or Fixed Amount</p></label>
					<div class="col-sm-8">
						<select class="form-control" name="coupon_type" id="type">
						<option value="percentage" @if($coupon->coupon_type == 'percentage') selected @endif>Percentage</option>
						<option value="fixed_amt" @if($coupon->coupon_type == 'fixed_amt') selected @endif>Fixed Amount</option>
					</select>
					@if($errors->has('coupon_type')) <span class="text-danger">{{$errors->first('coupon_type')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="discount" class="col-sm-4 control-label">Discount:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="discount" value="{{Old('discount') ? Old('discount') : $coupon->discount}}" name="discount" placeholder="">
						@if($errors->has('discount')) <span class="text-danger">{{$errors->first('discount')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="total-amount"  class="col-sm-4 control-label">Total Amount:<br/><p style="font-size:10px">The total amount that must reach before the coupon is valid.</p></label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="total-amount" value="{{Old('minimum_order_amt') ? Old('minimum_order_amt') : $coupon->minimum_order_amt}}" name="minimum_order_amt" placeholder="">
						@if($errors->has('minimum_order_amt')) <span class="text-danger">{{$errors->first('minimum_order_amt')}}</span> @endif
					</div>
					<div class="col-sm-4">
						<select class="form-control" name="minimum_order_amt_type" id="status">
						<option value="cart" @if($coupon->minimum_order_amt_type == 'cart') selected @endif>Cart Total</option>
						<option value="product" @if($coupon->minimum_order_amt_type == 'product') selected @endif> Product Total</option>
					</select>
					@if($errors->has('minimum_order_amt_type')) <span class="text-danger">{{$errors->first('minimum_order_amt_type')}}</span> @endif
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Select Products:</label>
					<div class="col-sm-8">
					<label class="custom-control custom-radio">
						<input id="radio1" name="radio" type="radio" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Product</span>
					</label>
					<label class="custom-control custom-radio">
						<input id="radio2" name="radio" type="radio" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Category</span>
					</label>
					</div>
				</div>
				<div class="form-group" style="padding-bottom:56px">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Customer Login:<br/><p style="font-size:10px">Customer must be logged in to use the coupon.</p></label>
					<div class="col-sm-8">
					<label class="custom-control custom-radio">
						<input id="radio1" name="radio" type="radio" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Yes</span>
					</label>
					<label class="custom-control custom-radio">
						<input id="radio2" name="radio" type="radio" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">No</span>
					</label>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Free Shipping:</label>
					<div class="col-sm-8">
					<label class="custom-control custom-radio">
						<input id="radio1" name="free_shipping" @if($coupon->free_shipping == 'yes') checked @endif type="radio" value="yes" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Yes</span>
					</label>
					<label class="custom-control custom-radio">
						<input id="radio2" name="free_shipping" @if($coupon->free_shipping == 'no') checked @endif type="radio" value="no" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">No</span>
					</label>
					@if($errors->has('free_shipping')) <span class="text-danger">{{$errors->first('free_shipping')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Date Start:</label>
					<div class="col-sm-8">
					<input class="form-control" type="date"  name="start_date" value="{{Old('start_date') ? Old('start_date') : $coupon->date_start}}" id="example-date-input">
					@if($errors->has('start_date')) <span class="text-danger">{{$errors->first('start_date')}}</span> @endif
					</div>
					
				</div>
				<div class="form-group row">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Date End:</label>
					<div class="col-sm-8">
					<input class="form-control" type="date" name="end_date" value="{{Old('end_date') ? Old('end_date') : $coupon->date_end}}" id="example-date-input">
					@if($errors->has('end_date')) <span class="text-danger">{{$errors->first('end_date')}}</span> @endif
					</div>
					
				</div>
				<div class="form-group row">
					<label for="uses-per-coupon" class="col-sm-4 control-label">Uses Per Coupon:<br/><p style="font-size:10px">The maximum number of times the coupon can be used by any customer. Leave blank for unlimited</p></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="uses-per-coupon" value="{{Old('per_coupon_limit') ? Old('per_coupon_limit') : $coupon->per_coupon_limit}}" name="per_coupon_limit" placeholder="1">
						@if($errors->has('per_coupon_limit')) <span class="text-danger">{{$errors->first('per_coupon_limit')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="uses-per-customer" class="col-sm-4 control-label">Uses Per Customer:<br/><p style="font-size:10px">The maximum number of times the coupon can be used by a single customer. Leave blank for unlimited</p></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" value="{{Old('per_user_limit') ? Old('per_user_limit') : $coupon->per_user_limit}}" id="uses-per-coupon" name="per_user_limit" placeholder="1">
						@if($errors->has('per_user_limit')) <span class="text-danger">{{$errors->first('per_user_limit')}}</span> @endif
					</div>
				</div>
				<!-- <div class="form-group" style="padding-bottom:72px">
					<label for="uses-per-customer" class="col-sm-4 control-label">Customer Groups:<br/><p style="font-size:10px">Choose the specific customer group the coupon will apply to.</p></label>
					<div class="col-sm-8">
						<select name="to_customer_type[]" multiple id="langOpt">
						<option value="Customer">Customer</option>
						<option value="Default">Default</option>
						<option value="Wholesale">Wholesale</option>
						</select>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="description" class="col-sm-4 control-label">Description:</label>
					<div class="col-sm-8">
						<textarea class="form-control" name="description" id="description" rows="4" style="resize:none;">{{Old('description') ? Old('description') : $coupon->description}}</textarea>
						@if($errors->has('description')) <span class="text-danger">{{$errors->first('description')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="status" class="col-sm-4 control-label">Status:</label>
					<div class="col-sm-8">
						<select class="form-control" name="status" id="status">
						<option value="enabled" @if($coupon->status == 'enabled') selected @endif>Enabled</option>
						<option value="disabled" @if($coupon->status == 'disabled') selected @endif>Disabled</option>
					</select>
					@if($errors->has('status')) <span class="text-danger">{{$errors->first('status')}}</span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="status" class="col-sm-4 control-label"></label>
					<div class="col-sm-8">
					<input type="submit" name="save" value="Update" class="btn btn-success">	
					</div>	
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection